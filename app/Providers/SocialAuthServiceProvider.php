<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use App\Http\Grants\CustomGrant;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Bridge\UserRepository;
use League\OAuth2\Server\AuthorizationServer;
use Laravel\Passport\Bridge\RefreshTokenRepository;

class SocialAuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        app()->afterResolving(AuthorizationServer::class, function (AuthorizationServer $server) {
            $grant = $this->makeGrant();
            $server->enableGrantType($grant, Passport::tokensExpireIn());
        });
    }

    private function makeGrant()
    {
        $grant = new CustomGrant(
            $this->app->make(UserRepository::class),
            $this->app->make(RefreshTokenRepository::class),
        );
        $grant->setRefreshTokenTTL(Passport::refreshTokensExpireIn());
        return $grant;
    }
}
