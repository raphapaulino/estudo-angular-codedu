<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\ProductInput;
use App\Models\ProductOutput;
use App\Models\User;
use App\Models\UserTenant;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        ResetPassword::toMailUsing(function ($user, $token) {
            $routeReset = $user->containsType(Admin::class) ? 'admin.password.reset' : 'app.password.reset';
            $url        = url(config('app.url').route($routeReset, [
                'token' => $token,
                'email' => $user->email,
            ], false));

            return (new MailMessage)
                ->from($user->email, $user->name)
                ->subject(\Lang::get('Reset Password Notification'))
                ->line(\Lang::get('You are receiving this email because we received a password reset request for your account.'))
                ->action(\Lang::get('Reset Password'), $url)
                ->line(\Lang::get('This password reset link will expire in :count minutes.', 
                    ['count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire')]))
                ->line(\Lang::get('If you did not request a password reset, no further action is required.'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Validator::extend('is_admin', function($attribute, $value, $parameters, $validator) {
            $user = User::whereEmail($value)->first();
            return $user && $user->containsType(Admin::class);
        });

        \Validator::extend('is_user_tenant', function($attribute, $value, $parameters, $validator) {
            $user = User::whereEmail($value)->first();
            return $user && $user->containsType(UserTenant::class);
        });

        \Tenant::bluePrintMacros();

        ProductInput::created(function ($input) {
            $product = $input->product;
            $product->stock += $input->amount;
            $product->save();
        });

        ProductOutput::created(function ($output) {
            $product = $output->product;
            $product->stock -= $output->amount;
            if ($product->stock < 0) {
                // dd($product->stock);
                // throw new \Exception("Estoque de {$product->name} não pode ser negativo");
                $product->stock = 0;
            }
            $product->save();
        });
    }
}
