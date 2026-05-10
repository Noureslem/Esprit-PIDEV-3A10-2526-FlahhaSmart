<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Psr\Log\LoggerInterface;

class EmailService
{
    private MailerInterface $mailer;
    private LoggerInterface $logger;

    public function __construct(MailerInterface $mailer, LoggerInterface $logger)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    public function sendResetCode(string $toEmail, string $prenom, string $code): bool
    {
        try {
            $this->logger->info('Tentative envoi email à: ' . $toEmail);
            
            $email = (new Email())
                ->from(new \Symfony\Component\Mime\Address('dhaouadi.eya@esprit.tn', 'FlahaSmart'))
                ->to($toEmail)
                ->subject('🔐 Réinitialisation de votre mot de passe')
                ->text("Bonjour $prenom,\n\nVotre code de réinitialisation est : $code\n\nCe code expire dans 15 minutes.\n\nCordialement,\nL'équipe FlahaSmart")
                ->html($this->getResetCodeHtml($prenom, $code));
            
            $this->mailer->send($email);
            $this->logger->info('Email envoyé avec succès à: ' . $toEmail);
            return true;
            
        } catch (\Exception $e) {
            $this->logger->error('Erreur envoi email: ' . $e->getMessage());
            return false;
        }
    }

    public function sendVerificationCode(string $toEmail, string $prenom, string $code): bool
    {
        try {
            $email = (new Email())
                ->from(new \Symfony\Component\Mime\Address('dhaouadi.eya@esprit.tn', 'FlahaSmart'))
                ->to($toEmail)
                ->subject('🔐 Vérification de votre compte')
                ->text("Bonjour $prenom,\n\nVotre code de vérification est : $code\n\nCe code expire dans 15 minutes.\n\nCordialement,\nL'équipe FlahaSmart")
                ->html($this->getVerificationCodeHtml($prenom, $code));
            
            $this->mailer->send($email);
            return true;
            
        } catch (\Exception $e) {
            $this->logger->error('Erreur envoi code vérification: ' . $e->getMessage());
            return false;
        }
    }

    public function sendWelcomeEmail(string $toEmail, string $prenom): bool
    {
        try {
            $email = (new Email())
                ->from(new \Symfony\Component\Mime\Address('dhaouadi.eya@esprit.tn', 'FlahaSmart'))
                ->to($toEmail)
                ->subject('Bienvenue sur FlahaSmart ! 🌿')
                ->text("Bonjour $prenom,\n\nBienvenue sur FlahaSmart ! Votre compte a été créé avec succès.\n\nCordialement,\nL'équipe FlahaSmart")
                ->html($this->getWelcomeHtml($prenom));
            
            $this->mailer->send($email);
            return true;
            
        } catch (\Exception $e) {
            $this->logger->error('Erreur envoi bienvenue: ' . $e->getMessage());
            return false;
        }
    }

    private function getResetCodeHtml(string $prenom, string $code): string
    {
        return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f3; margin: 0; padding: 0; }
        .container { max-width: 500px; margin: 20px auto; background: white; border-radius: 16px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header { background: #1e293b; color: white; padding: 20px; text-align: center; border-radius: 16px 16px 0 0; margin: -20px -20px 20px -20px; }
        .code { font-size: 36px; font-weight: bold; color: #d97706; background: #fffbeb; padding: 15px; text-align: center; border-radius: 10px; margin: 20px 0; letter-spacing: 5px; }
        .footer { text-align: center; color: #999; font-size: 12px; margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>🔐 FlahaSmart</h2>
            <p>Réinitialisation du mot de passe</p>
        </div>
        <div class="content">
            <p>Bonjour <strong>{$prenom}</strong>,</p>
            <p>Vous avez demandé la réinitialisation de votre mot de passe.</p>
            <p>Voici votre code de validation :</p>
            <div class="code">{$code}</div>
            <p>Ce code expire dans <strong>15 minutes</strong>.</p>
            <p>Si vous n'avez pas demandé cette réinitialisation, ignorez cet email.</p>
        </div>
        <div class="footer">
            © 2025 FlahaSmart - Tous droits réservés
        </div>
    </div>
</body>
</html>
HTML;
    }

    private function getVerificationCodeHtml(string $prenom, string $code): string
    {
        return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f3; margin: 0; padding: 0; }
        .container { max-width: 500px; margin: 20px auto; background: white; border-radius: 16px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header { background: #2d5a1e; color: white; padding: 20px; text-align: center; border-radius: 16px 16px 0 0; margin: -20px -20px 20px -20px; }
        .code { font-size: 36px; font-weight: bold; color: #2d5a1e; background: #f0f7ed; padding: 15px; text-align: center; border-radius: 10px; margin: 20px 0; letter-spacing: 5px; }
        .footer { text-align: center; color: #999; font-size: 12px; margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>🌿 FlahaSmart</h2>
            <p>Vérification de votre compte</p>
        </div>
        <div class="content">
            <p>Bonjour <strong>{$prenom}</strong>,</p>
            <p>Merci de vous être inscrit sur FlahaSmart.</p>
            <p>Voici votre code de vérification :</p>
            <div class="code">{$code}</div>
            <p>Ce code expire dans <strong>15 minutes</strong>.</p>
        </div>
        <div class="footer">
            © 2025 FlahaSmart - Tous droits réservés
        </div>
    </div>
</body>
</html>
HTML;
    }

    private function getWelcomeHtml(string $prenom): string
    {
        return <<<HTML
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f7f3; margin: 0; padding: 0; }
        .container { max-width: 500px; margin: 20px auto; background: white; border-radius: 16px; padding: 20px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .header { background: #2d5a1e; color: white; padding: 20px; text-align: center; border-radius: 16px 16px 0 0; margin: -20px -20px 20px -20px; }
        .footer { text-align: center; color: #999; font-size: 12px; margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>🌿 FlahaSmart</h2>
        </div>
        <div class="content">
            <h2>Bienvenue {$prenom} ! 🎉</h2>
            <p>Votre compte a été créé avec succès.</p>
            <p>Vous pouvez maintenant vous connecter.</p>
        </div>
        <div class="footer">
            © 2025 FlahaSmart - Tous droits réservés
        </div>
    </div>
</body>
</html>
HTML;
    }
}