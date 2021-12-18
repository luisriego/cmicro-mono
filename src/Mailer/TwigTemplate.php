<?php

declare(strict_types=1);

namespace App\Mailer;

final class TwigTemplate
{
    public const REGISTER_USER = 'user/welcome.html.twig';
    public const CHANGE_PASSWORD = 'user/changePassword.html.twig';
    public const RESET_PASSWORD = 'user/resetPassword.html.twig';
    public const RESEND_ACTIVATION_EMAIL = 'user/resendActivationEmail.html.twig';
//    public const REGISTER_USER = 'user/welcome.html.twig';
}