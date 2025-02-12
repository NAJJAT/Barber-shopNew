<?php

namespace App\Providers;

use App\Models\Comment; // Add this line
use App\Policies\CommentPolicy; // Add this line
use App\Models\FAQ; // Add this line
use App\Policies\FAQPolicy; // Add this line
// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
  


    protected $policies = [
        FAQ::class => FAQPolicy::class,
    ];


    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
    
}
