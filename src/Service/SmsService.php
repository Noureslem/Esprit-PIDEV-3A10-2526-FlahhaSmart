<?php

namespace App\Service;

use App\Entity\Users;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\TexterInterface;
use Twig\Environment;

class SmsService
{
    private ?TexterInterface $texter = null;   // 👈 rendu nullable
    private LoggerInterface $logger;
    private LoggerInterface $smsLogger;
    private Environment $twig;
    private bool $useRealSms;

    public function __construct(
        ?TexterInterface $texter = null,       // 👈 explicite nullable
        LoggerInterface $logger,
        LoggerInterface $smsLogger,
        Environment $twig,
        ParameterBagInterface $params
    ) {
        $this->texter = $texter;
        $this->logger = $logger;
        $this->smsLogger = $smsLogger;
        $this->twig = $twig;

        $twilioSid = $_ENV['TWILIO_ACCOUNT_SID'] ?? null;
        $this->useRealSms = $twilioSid && $twilioSid !== 'null' && $texter !== null;
    }

    public function sendReactivationSms(Users $user, string $code): bool
    {
        if (!$user->getTelephone()) {
            $this->logger->warning('Pas de numéro pour: ' . $user->getEmail());
            return false;
        }

        $phone = $this->formatPhone($user->getTelephone());
        $message = $this->twig->render('sms/reactivation.txt.twig', [
            'user' => $user,
            'code' => $code,
        ]);

        $this->smsLogger->info('SMS envoyé', [
            'to' => $phone,
            'user_id' => $user->getId(),
            'type' => 'reactivation',
            'code' => $code,
            'message' => $message,
        ]);

        if (!$this->useRealSms) {
            $this->logger->info('📱 SIMULATION SMS', ['to' => $phone, 'code' => $code]);
            return true;
        }

        return $this->sendRealSms($phone, $message);
    }

    public function sendReactivationConfirmSms(Users $user): bool
    {
        if (!$user->getTelephone()) {
            return false;
        }

        $phone = $this->formatPhone($user->getTelephone());
        $message = $this->twig->render('sms/reactivation_confirm.txt.twig', ['user' => $user]);

        $this->smsLogger->info('SMS envoyé', [
            'to' => $phone,
            'user_id' => $user->getId(),
            'type' => 'confirmation',
            'message' => $message,
        ]);

        if (!$this->useRealSms) {
            $this->logger->info('📱 SIMULATION SMS CONFIRMATION', ['to' => $phone]);
            return true;
        }

        return $this->sendRealSms($phone, $message);
    }

    private function sendRealSms(string $to, string $message): bool
    {
        if (!$this->texter) {
            $this->logger->error('❌ Impossible d\'envoyer un SMS réel : aucun texter configuré.');
            return false;
        }

        try {
            $sms = new SmsMessage($to, $message);
            $this->texter->send($sms);
            $this->logger->info('✅ SMS réel envoyé à ' . $to);
            return true;
        } catch (\Exception $e) {
            $this->logger->error('❌ Erreur SMS: ' . $e->getMessage());
            $this->smsLogger->error('Échec envoi SMS', [
                'to' => $to,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    private function formatPhone(string $phone): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        if (strlen($phone) === 8) {
            return '+216' . $phone;
        }
        if (strlen($phone) === 10 && str_starts_with($phone, '0')) {
            return '+33' . substr($phone, 1);
        }
        if (!str_starts_with($phone, '+')) {
            return '+' . $phone;
        }
        return $phone;
    }
}