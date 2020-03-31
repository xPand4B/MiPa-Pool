<?php

namespace MiPaPo\Core\Components\Common\Traits;

use MiPaPo\Core\Components\User\Database\User;

trait MiPaPoMailer
{
    /**
     * The user that should receive this mail.
     *
     * @var User
     */
    public $user;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Optional: Special greeting.
     *
     * @var string|null
     */
    public $greeting;

    /**
     * The mail level (primary, success or error).
     *
     * @var string
     */
    public $level = 'primary';

    /**
     * Optional: Mail introduction lines.
     *
     * @var array|null
     */
    public $introLines = [];

    /**
     * Optional: The button action text.
     *
     * @var string|null
     */
    public $actionText;

    /**
     * Optional: The button action url.
     *
     * @var string|null
     */
    public $actionUrl;

    /**
     * Optional: Mail outro lines.
     *
     * @var array|null
     */
    public $outroLines = [];

    /**
     * Optional: Special salutation.
     *
     * @var string|null
     */
    public $salutation;

    /**
     * Set the password reset token.
     *
     * @param string $token
     *
     * @return void
     */
    public function setToken($token): void
    {
        $this->token = $token;
    }

    /**
     * Optional: Set a special greeting.
     *
     * @param string $greeting
     *
     * @return self
     */
    public function greeting(string $greeting): self
    {
        $this->greeting = $greeting;

        return $this;
    }

    /**
     * Set the mail level.
     *
     * @param string $level
     *
     * @return self
     */
    public function level(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Optional: Set the mail intro lines.
     *
     * @param array $lines
     *
     * @return self
     */
    public function introLines(array $lines): self
    {
        $this->introLines = $lines;

        return $this;
    }

    /**
     * Configure the "call to action" button.
     *
     * @param string $text
     * @param string $url
     *
     * @return self
     */
    public function action(string $text, string $url): self
    {
        $this->actionText = $text;
        $this->actionUrl = $url;

        return $this;
    }

    /**
     * Optional: Set the mail outro lines.
     *
     * @param array $lines
     *
     * @return self
     */
    public function outroLines(array $lines): self
    {
        $this->outroLines = $lines;

        return $this;
    }

    /**
     * Optional: Set a special salutation.
     *
     * @param string $salutation
     *
     * @return self
     */
    public function salutation(string $salutation): self
    {
        $this->salutation = $salutation;

        return $this;
    }
}
