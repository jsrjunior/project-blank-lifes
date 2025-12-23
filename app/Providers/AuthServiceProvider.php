<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\AddressType;
use App\Models\EmailType;
use App\Models\Life;
use App\Models\PhoneType;
use App\Models\Role;
use App\Models\User;
use App\Policies\AddressTypePolicy;
use App\Policies\DocumentTypePolicy;
use App\Policies\EmailTypePolicy;
use App\Policies\LifePolicy;
use App\Policies\PhoneTypePolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use Dom\DocumentType;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        AddressType::class              =>  AddressTypePolicy::class,
        DocumentType::class             =>  DocumentTypePolicy::class,
        EmailType::class                =>  EmailTypePolicy::class,
        Life::class                     =>  LifePolicy::class,
        Role::class                     =>  RolePolicy::class,
        PhoneType::class                =>  PhoneTypePolicy::class,
        User::class                     =>  UserPolicy::class,        
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        Gate::before(function ($user, $ability) {
        if (str_contains($ability, ',')) {
            [$action, $model] = explode(',', $ability);

            if (class_exists($model)) {
                return $user->can($action, $model);
            }
        }

        return null;
    });
    }
}
