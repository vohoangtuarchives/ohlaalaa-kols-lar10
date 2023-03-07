<?php

namespace App\Mail;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class CustomerVerifyEmail extends VerifyEmail
{
    protected function buildMailMessage($url)
    {
        return (new MailMessage)
            ->subject(Lang::get('Email xác nhận đăng ký thành viên'))
            ->line(Lang::get('Vui lòng click vào button bên dưới để xác nhận.'))
            ->action(Lang::get('Xác nhận'), $url)
            ->line(Lang::get('Nếu bạn không đăng ký dịch vụ bằng email này thì bạn không cần làm gì nữa.'));
    }

    /**
     * Get the verification URL for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return string
     */
    protected function verificationUrl($notifiable)
    {
        if (static::$createUrlCallback) {
            return call_user_func(static::$createUrlCallback, $notifiable);
        }

        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
}
