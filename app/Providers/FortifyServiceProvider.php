<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::loginView(function () {
            $userStudents = null;
            $userAdmin = null;
            return view('auth.login',compact('userStudents'
            ,'userAdmin'));
        });
        Fortify::registerView(function () {
            $userStudents = null;
            $userAdmin = null;
            return view('auth.register',compact('userStudents'
            ,'userAdmin'));
        });
        Fortify::requestPasswordResetLinkView(function () {
            $userStudents = null;
            $userAdmin = null;
            return view('auth.forgot-password',compact('userStudents'
            ,'userAdmin'));
        });
        Fortify::resetPasswordView(function () {
            $userStudents = null;
            $userAdmin = null;
            return view('auth.reset-password',compact('userStudents'
            ,'userAdmin'));
        });
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

    }
}
