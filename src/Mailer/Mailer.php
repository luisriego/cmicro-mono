<?php

declare(strict_types=1);

namespace App\Mailer;

use Psr\Log\LoggerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Twig\Environment;

class Mailer implements IMailer
{
    public const TEMPLATE_SUBJECT_MAP = [
        TwigTemplate::REGISTER_USER => 'Welcome to Clínica do Micro App!',
        TwigTemplate::CHANGE_PASSWORD => 'Do you want to change your password?',
        TwigTemplate::RESET_PASSWORD => 'You claim to us reset your password!',
        TwigTemplate::RESEND_ACTIVATION_EMAIL => 'You claim for a new activation email!',
    ];

    public function __construct(
        private MailerInterface $mailer,
        private Environment $engine,
        private LoggerInterface $logger,
        private string $defaultSender
    )
    {
    }

    /**
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\LoaderError
     */
    public function send(string $receiver, string $template, array $payload): void
    {
        $email = (new Email())
            ->from($this->defaultSender)
            ->to($receiver)
            ->subject(self::TEMPLATE_SUBJECT_MAP[$template])
            ->html($this->engine->render($template, $payload));

        try {
            $this->mailer->send($email);
            $this->logger->info(sprintf('Email sent to %s', $receiver));
        } catch (TransportExceptionInterface $e) {
            $this->logger->error(sprintf('Error sending email to %s. Error message: %s', $receiver, $e->getMessage()));
        }

    }
}