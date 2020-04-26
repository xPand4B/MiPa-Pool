<?php

namespace MiPaPo\Core\Components\Jwt\Tests;

use MiPaPo\Core\Components\User\Database\User;
use MiPaPo\Core\Components\User\Tests\UserTestCaseTrait;
use Tymon\JWTAuth\Facades\JWTAuth;

trait AuthTestCaseTrait
{
    use UserTestCaseTrait;

    /**
     * @var User
     */
    private $loginUser;

    /**
     * @var string
     */
    private $token;

    /**
     * Login as the specified user.
     *
     * @param User $user
     * @return $this
     */
    public function loginAs(User $user): self
    {
        $this->loginUser = $user;
        $this->token = JWTAuth::fromUser($this->loginUser);

        return $this;
    }

    /**
     * Set the jwt token.
     *
     * @param string $token
     * @return $this
     */
    protected function setJwtToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get the jwt token.
     *
     * @return mixed
     */
    protected function getJwtToken()
    {
        return is_null($this->loginUser) ? null : $this->token;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $parameters
     * @param array $cookies
     * @param array $files
     * @param array $server
     * @param string $content
     *
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    public function call ($method, $uri, $parameters = [], $cookies = [], $files = [], $server = [], $content = null) {
        if ($this->requestNeedsToken($method, $uri)) {
            $server = $this->attachToken($server);
        }

        return parent::call($method, $uri, $parameters, $cookies, $files, $server, $content);
    }

    /**
     * @param string $method
     * @param string $uri
     *
     * @return bool
     */
    protected function requestNeedsToken ($method, $uri) {
        return !($method === "POST" && ($uri === "/auth" || $uri === "/route-without-auth"));
    }

    /**
     * @param array $server
     *
     * @return array
     */
    protected function attachToken (array $server) {
        return array_merge($server, $this->transformHeadersToServerVars([
            'Authorization' => 'Bearer ' . $this->getJwtToken(),
        ]));
    }
}