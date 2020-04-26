<?php

namespace MiPaPo\Core\Events;

// TODO: GH-40 - Implement events
use MiPaPo\Core\Components\Jwt\Http\Controller\Api\LoginController;
use MiPaPo\Core\Components\Jwt\Http\Controller\Api\LogoutController;
use MiPaPo\Core\Components\Jwt\Http\Controller\Api\MeController;

class AuthEvents
{
    /**
     * @see LoginController::login()
     */
    const BEFORE_LOGIN              = 'auth.login.before';
    const AFTER_LOGIN               = 'auth.login.after';
    const LOGIN_INVALID_CREDENTIALS = 'auth.login.credentials.invalid';
    const LOGIN_WRONG_CREDENTIALS   = 'auth.login.credentials.wrong';

    /**
     * @see LogoutController::logout()
     */
    const BEFORE_LOGOUT = 'auth.logout.before';
    const AFTER_LOGOUT  = 'auth.logout.after';

    /**
     * @see MeController::me()
     */
    const BEFORE_ME = 'auth.me.before';
    const AFTER_ME  = 'auth.me.after';

    /**
     * @see MeController::refresh()
     */
    const BEFORE_REFRESH_TOKEN  = 'auth.me.token.refresh.before';
    const AFTER_REFRESH_TOKEN   = 'auth.me.token.refresh.after';

    /**
     * @see MeController::update()
     */
    const BEFORE_ME_UPDATE      = 'auth.me.update.before';
    const AFTER_ME_UPDATE       = 'auth.me.update.after';
}