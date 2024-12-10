<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Passage\Authentication;

final readonly class Authentication
{
    private readonly Client $client;

    public function __construct(array $config)
    {
        $this->client = new Client($config);
    }

    public function apps(): Apps
    {
        return new Apps($this->client);
    }

    public function authenticatedUsers(string $token): AuthenticatedUsers
    {
        return new AuthenticatedUsers($this->client->withToken($token));
    }

    public function magicLink(): MagicLinks
    {
        return new MagicLinks($this->client);
    }

    public function sessionManagement(): SessionManagement
    {
        return new SessionManagement($this->client);
    }

    public function users(): Users
    {
        return new Users($this->client);
    }

    public function webAuthn(): WebAuthn
    {
        return new WebAuthn($this->client);
    }
}
