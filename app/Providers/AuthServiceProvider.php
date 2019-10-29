<?php

namespace App\Providers;

use App\Role;
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

        // authorize edit and destroy comments for comment owner admin and post owner
        Gate::define('edit-comment', function ($user, $comment) {
            return $user->id == $comment->user_id || $user->hasRole('admin') || $comment->post->user_id == $user->id;
        });
    }
}
