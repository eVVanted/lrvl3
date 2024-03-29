<?php

namespace Corp\Providers;

use Corp\Article;
use Corp\Menu;
use Corp\Permission;
use Corp\Policies\ArticlePolicy;
use Corp\Policies\MenusPolicy;
use Corp\Policies\PermissionPolicy;
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
        Article::class => ArticlePolicy::class,
        Permission::class => PermissionPolicy::class,
        Menu::class => MenusPolicy::class,
        // 'Corp\Model' => 'Corp\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('VIEW_ADMIN', function($user){
            return $user->canDo('VIEW_ADMIN',false);
        });

        Gate::define('VIEW_ADMIN_ARTICLES', function($user){
            return $user->canDo('VIEW_ADMIN_ARTICLES',false);
        });

        Gate::define('EDIT_USERS', function($user){
            return $user->canDo('EDIT_USERS',false);
        });

        Gate::define('VIEW_ADMIN_MENU', function($user){
            return $user->canDo('VIEW_ADMIN_MENU',false);
        });

        //
    }
}
