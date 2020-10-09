<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // https://laravel.com/docs/8.x/authorization#writing-gates
        Gate::define('create-posts', function ($user) {
            return $user->id > 0;
        });
        Gate::define('update-post', function ($user, $post) {
            return $post->user_id === $user->id;
        });
        Gate::define('delete-post', function ($user, $post) {
            return $post->user_id === $user->id;
        });
    }
}
