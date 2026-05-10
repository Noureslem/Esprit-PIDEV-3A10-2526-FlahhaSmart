<?php

namespace App\Controller;

use App\Entity\Notification;
use App\Entity\Users;
use App\Form\RegistrationFormType;
use App\Repository\UsersRepository;
use App\Service\EmailService;
use App\Service\SmsService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3Validator;

class AuthController extends AbstractController
{
    use TranslatableControllerTrait;

    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $passwordHasher;
    private UsersRepository $usersRepository;
    private EmailService $emailService;
    private SmsService $smsService;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher,
        UsersRepository $usersRepository,
        EmailService $emailService,
        SmsService $smsService
    ) {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
        $this->usersRepository = $usersRepository;
        $this->emailService = $emailService;
        $this->smsService = $smsService;
    }

    private function generateCode(): string
    {
        return str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
    }

    private function isCodeValid(int $timestamp): bool
    {
        return (time() - $timestamp) <= 900;
    }

    // ================= INSCRIPTION AVEC VÉRIFICATION EMAIL =================

    #[Route('/register', name: 'app_register')]
    public function register(Request $request): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_dashboard');
        }

        $user = new Users();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Vérifications supplémentaires non gérées par le formulaire
            $errors = [];

            // Vérifier si l'email existe déjà
            if ($this->usersRepository->findByEmail($user->getEmail())) {
                $errors['email'] = $this->trans('auth.email_already_used');
            }

            // Vérifier le téléphone (format)
            $telephone = $user->getTelephone();
            if (!empty($telephone) && !preg_match('/^[0-9]{8}$/', $telephone)) {
                $errors['telephone'] = $this->trans('auth.telephone_invalid');
            }

            // Vérifier le mot de passe (si le formulaire ne le fait pas déjà)
            $plainPassword = $form->get('plainPassword')->getData();
            if (strlen($plainPassword) < 8) {
                $errors['password'] = $this->trans('auth.password_too_short');
            } elseif (!preg_match('/[A-Z]/', $plainPassword)) {
                $errors['password'] = $this->trans('auth.password_no_uppercase');
            } elseif (!preg_match('/[a-z]/', $plainPassword)) {
                $errors['password'] = $this->trans('auth.password_no_lowercase');
            } elseif (!preg_match('/[0-9]/', $plainPassword)) {
                $errors['password'] = $this->trans('auth.password_no_digit');
            }

            if (count($errors) > 0) {
                foreach ($errors as $key => $message) {
                    $this->addFlash('error', $message);
                }
                return $this->render('auth/register.html.twig', [
                    'registrationForm' => $form->createView(),
                ]);
            }

            // Générer code et timestamp
            $code = $this->generateCode();
            $timestamp = time();

            // Stocker les données temporairement en session
            $session = $request->getSession();
            $session->set('temp_user_data', [
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom(),
                'email' => $user->getEmail(),
                'telephone' => $telephone,
                'ville' => $user->getVille(),
                'role' => $user->getRole(),
            ]);
            $session->set('temp_password', $plainPassword);
            $session->set('verification_code', $code);
            $session->set('code_timestamp', $timestamp);

            // Envoi du code par email
            $sent = $this->emailService->sendVerificationCode(
                $user->getEmail(),
                $user->getPrenom(),
                $code
            );

            if ($sent) {
                $this->addFlash('info', $this->trans('flash.auth.code_sent'));
                return $this->redirectToRoute('app_verify_code');
            } else {
                $this->addFlash('error', $this->trans('flash.auth.code_send_failed'));
            }
        }

        return $this->render('auth/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verify-code', name: 'app_verify_code')]
    public function verifyCode(Request $request): Response
    {
        $session = $request->getSession();
        $tempUser = $session->get('temp_user_data');

        if (!$tempUser) {
            return $this->redirectToRoute('app_register');
        }

        if ($request->isMethod('POST')) {
            $enteredCode = $request->request->get('code');
            $storedCode = $session->get('verification_code');
            $timestamp = $session->get('code_timestamp');

            if ($enteredCode === $storedCode && $this->isCodeValid($timestamp)) {
                $user = new Users();
                $user->setNom($tempUser['nom']);
                $user->setPrenom($tempUser['prenom']);
                $user->setEmail($tempUser['email']);
                $user->setTelephone(!empty($tempUser['telephone']) ? $tempUser['telephone'] : null);
                $user->setVille(!empty($tempUser['ville']) ? $tempUser['ville'] : null);
                $user->setRole($tempUser['role']);
                $user->setPassword($this->passwordHasher->hashPassword($user, $session->get('temp_password')));

                try {
                    $this->entityManager->persist($user);
                    $this->entityManager->flush();

                    // Email de bienvenue
                    $this->emailService->sendWelcomeEmail($user->getEmail(), $user->getPrenom());

                    // Notification admin
                    $notificationMessage = sprintf(
                        'Nouveau compte créé : %s %s (%s)',
                        $user->getPrenom(),
                        $user->getNom(),
                        $user->getEmail()
                    );
                    $notification = new Notification(
                        $notificationMessage,
                        'user_registration',
                        $this->generateUrl('admin_users')
                    );
                    $this->entityManager->persist($notification);
                    $this->entityManager->flush();

                    // Nettoyage session
                    $session->remove('temp_user_data');
                    $session->remove('temp_password');
                    $session->remove('verification_code');
                    $session->remove('code_timestamp');

                    $this->addFlash('success', $this->trans('flash.auth.registration_success'));
                    return $this->redirectToRoute('app_login');
                } catch (\Exception $e) {
                    $this->addFlash('error', $this->trans('flash.auth.registration_error'));
                    return $this->redirectToRoute('app_register');
                }
            } else {
                if ($enteredCode !== $storedCode) {
                    $this->addFlash('error', $this->trans('flash.auth.invalid_code'));
                } else {
                    $this->addFlash('error', $this->trans('flash.auth.code_expired'));
                }
            }
        }

        return $this->render('auth/verify_code.html.twig');
    }

    #[Route('/resend-code', name: 'app_resend_code')]
    public function resendCode(Request $request): Response
    {
        $session = $request->getSession();
        $tempUser = $session->get('temp_user_data');

        if (!$tempUser) {
            return $this->redirectToRoute('app_register');
        }

        $newCode = $this->generateCode();
        $session->set('verification_code', $newCode);
        $session->set('code_timestamp', time());

        $this->emailService->sendVerificationCode(
            $tempUser['email'],
            $tempUser['prenom'],
            $newCode
        );

        $this->addFlash('info', $this->trans('flash.auth.code_resent'));
        return $this->redirectToRoute('app_verify_code');
    }

    // ================= MOT DE PASSE OUBLIÉ =================

    #[Route('/forgot-password', name: 'app_forgot_password')]
    public function forgotPassword(Request $request): Response
    {
        if ($request->isMethod('POST')) {
            $email = trim((string) $request->request->get('email', ''));
            $user = $this->usersRepository->findOneBy(['email' => $email]);

            if ($user) {
                $code = $this->generateCode();
                $timestamp = time();

                $request->getSession()->set('reset_email', $email);
                $request->getSession()->set('reset_code', $code);
                $request->getSession()->set('reset_timestamp', $timestamp);

                $sent = $this->emailService->sendResetCode($email, $user->getPrenom(), $code);

                if ($sent) {
                    $this->addFlash('info', $this->trans('flash.auth.reset_code_sent'));
                    return $this->redirectToRoute('app_verify_reset_code');
                } else {
                    $this->addFlash('error', $this->trans('flash.auth.reset_code_failed'));
                }
            } else {
                $this->addFlash('error', $this->trans('flash.auth.email_not_found'));
            }
        }

        return $this->render('auth/forgot_password.html.twig');
    }

    #[Route('/verify-reset-code', name: 'app_verify_reset_code')]
    public function verifyResetCode(Request $request): Response
    {
        $session = $request->getSession();
        $resetEmail = $session->get('reset_email');

        if (!$resetEmail) {
            return $this->redirectToRoute('app_forgot_password');
        }

        if ($request->isMethod('POST')) {
            $enteredCode = $request->request->get('code');
            $storedCode = $session->get('reset_code');
            $timestamp = $session->get('reset_timestamp');

            if ($enteredCode === $storedCode && $this->isCodeValid($timestamp)) {
                return $this->redirectToRoute('app_reset_password');
            } else {
                $this->addFlash('error', $this->trans('flash.auth.invalid_or_expired_code'));
            }
        }

        return $this->render('auth/verify_reset_code.html.twig');
    }

    #[Route('/reset-password', name: 'app_reset_password')]
    public function resetPassword(Request $request): Response
    {
        $session = $request->getSession();
        $resetEmail = $session->get('reset_email');

        if (!$resetEmail) {
            return $this->redirectToRoute('app_forgot_password');
        }

        if ($request->isMethod('POST')) {
            $newPassword = $request->request->get('password');
            $confirmPassword = $request->request->get('confirm_password');

            if (strlen($newPassword) < 8) {
                $this->addFlash('error', $this->trans('auth.password_too_short'));
            } elseif (!preg_match('/[A-Z]/', $newPassword)) {
                $this->addFlash('error', $this->trans('auth.password_no_uppercase'));
            } elseif (!preg_match('/[a-z]/', $newPassword)) {
                $this->addFlash('error', $this->trans('auth.password_no_lowercase'));
            } elseif (!preg_match('/[0-9]/', $newPassword)) {
                $this->addFlash('error', $this->trans('auth.password_no_digit'));
            } elseif ($newPassword !== $confirmPassword) {
                $this->addFlash('error', $this->trans('auth.password_mismatch'));
            } else {
                $user = $this->usersRepository->findOneBy(['email' => $resetEmail]);
                if ($user) {
                    $user->setPassword($this->passwordHasher->hashPassword($user, $newPassword));
                    $this->entityManager->flush();

                    $session->remove('reset_email');
                    $session->remove('reset_code');
                    $session->remove('reset_timestamp');

                    $this->addFlash('success', $this->trans('flash.auth.password_reset_success'));
                    return $this->redirectToRoute('app_login');
                }
            }
        }

        return $this->render('auth/reset_password.html.twig');
    }

    // ================= CONNEXION AVEC reCAPTCHA ET RÉACTIVATION COMPTE =================

    #[Route('/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function login(
        Request $request,
        AuthenticationUtils $authenticationUtils,
        Recaptcha3Validator $recaptcha3Validator
    ): Response {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_dashboard');
        }

        // Traitement POST (appelé par le formulaire de login)
        if ($request->isMethod('POST')) {
            $email = trim((string) $request->request->get('email', $request->request->get('_username', '')));
            $password = (string) $request->request->get('password', $request->request->get('_password', ''));

            // Vérifier si le compte existe et est désactivé
            if (!empty($email) && !empty($password)) {
                $user = $this->usersRepository->findOneBy(['email' => $email]);

                if ($user && !$user->getActif() && $user->getDeactivatedAt()) {
                    // Compte désactivé → envoyer code SMS
                    $code = $this->generateCode();
                    $user->setReactivationCode($code);
                    $user->setReactivationCodeExpiresAt(new \DateTime('+15 minutes'));
                    $this->entityManager->flush();

                    $this->smsService->sendReactivationSms($user, $code);

                    $this->addFlash('warning', $this->trans('flash.auth.account_disactivated_sms_sent'));
                    $request->getSession()->set('email_to_verify', $email);

                    return $this->redirectToRoute('app_verify_reactivation');
                }
            }

            // reCAPTCHA
            $recaptchaToken = $request->request->get('recaptcha_token');
            if (empty($recaptchaToken)) {
                $this->addFlash('error', $this->trans('flash.auth.recaptcha_required'));
                return $this->redirectToRoute('app_login');
            }

            try {
                $score = $recaptcha3Validator->verify($recaptchaToken);
                if ($score < 0.5) {
                    $this->addFlash('error', $this->trans('flash.auth.recaptcha_failed'));
                    return $this->redirectToRoute('app_login');
                }
            } catch (\Exception $e) {
                $this->addFlash('error', $this->trans('flash.auth.recaptcha_error'));
                return $this->redirectToRoute('app_login');
            }
        }

        // Affichage du formulaire (GET ou après erreur de validation)
        return $this->render('auth/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'recaptcha_site_key' => $this->getParameter('karser_recaptcha3.site_key'),
        ]);
    }

    #[Route('/verify-reactivation', name: 'app_verify_reactivation')]
    public function verifyReactivation(Request $request): Response
    {
        $error = null;
        $email = $request->getSession()->get('email_to_verify');

        if (!$email) {
            return $this->redirectToRoute('app_login');
        }

        if ($request->isMethod('POST')) {
            $code = trim($request->request->get('code', ''));
            $user = $this->usersRepository->findOneBy(['email' => $email]);

            if ($user &&
                $user->getReactivationCode() === $code &&
                $user->getReactivationCodeExpiresAt() > new \DateTime()) {

                // Réactiver le compte
                $user->setActif(true);
                $user->setDeactivatedAt(null);
                $user->setReactivationCode(null);
                $user->setReactivationCodeExpiresAt(null);
                $this->entityManager->flush();

                $request->getSession()->remove('email_to_verify');
                $this->addFlash('success', $this->trans('flash.auth.account_reactivated'));

                return $this->redirectToRoute('app_login');
            } else {
                $error = $this->trans('flash.auth.invalid_or_expired_code');
            }
        }

        return $this->render('auth/verify_reactivation.html.twig', [
            'email' => $email,
            'error' => $error,
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method should be reached only via the logout system.');
    }
}
