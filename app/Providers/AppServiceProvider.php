<?php

namespace App\Providers;

use App\Services\SocialUserResolver;
use Illuminate\Support\ServiceProvider;
use Coderello\SocialGrant\Resolvers\SocialUserResolverInterface;

class AppServiceProvider extends ServiceProvider
{

    public $bindings = [
        SocialUserResolverInterface::class => SocialUserResolver::class,
    ];

    public function register()
    {

    }

    public function boot()
    {

    }
}
