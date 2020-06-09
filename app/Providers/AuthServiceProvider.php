<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // authorize edit comments for comment owner
        Gate::define('edit-comment', function ($user, $comment) {
            return $user->id == $comment->user_id;
        });

        Gate::define('destroy-comment', function ($user, $comment) {
            return $user->id == $comment->user_id || $user->hasRole('admin') || $comment->post->user_id == $user->id;
        });

        //edit profile
        Gate::define('edit-profile', function ($user, $profileUser) {
            return $user->id == $profileUser->id || $user->hasRole('admin');
        });

        //change password only for owner user
        Gate::define('change-password', function ($user, $profileUser) {
            return $user->id == $profileUser->id;
        });
    }
}
