<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */


        /**
         * Register any authentication / authorization services.
         *
         * @return void
         */
        public function boot()
    {

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            return (new MailMessage)
                ->subject('[ACADEMY] - KÍCH HOẠT TÀI KHOẢN')
                ->line('Click Vào nút bên dưới để kích hoạt.')
                ->action('Kích hoạt', $url)
                ->line('Nếu chưa tạo tài khoản thì không cần làm gì');

        });
    }

}
