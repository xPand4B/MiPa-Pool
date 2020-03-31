<?php

namespace MiPaPo\Core\System\Providers;

use MiPaPo\Core\Components\Passport\Database\AuthCode;
use MiPaPo\Core\Components\Passport\Database\Client;
use MiPaPo\Core\Components\Passport\Database\PersonalAccessClient;
use MiPaPo\Core\Components\Passport\Database\RefreshToken;
use MiPaPo\Core\Components\Passport\Database\Token;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->PassportSettings();
    }

    /**
     * Laravel/Passport settings.
     */
    private function PassportSettings(): void
    {
        Passport::routes();
        Passport::loadKeysFrom(base_path(config('core.path.oauth')));

        Passport::useTokenModel(Token::class);
        Passport::useClientModel(Client::class);
        Passport::useAuthCodeModel(AuthCode::class);
        Passport::useRefreshTokenModel(RefreshToken::class);
        Passport::usePersonalAccessClientModel(PersonalAccessClient::class);

        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
