<?php declare(strict_types=1);

/**
 * Copyright (C) BaseCode Oy - All Rights Reserved
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace BaseCodeOy\Passage\Management;

final readonly class Users
{
    public function __construct(
        private Client $client,
    ) {
        //
    }

    public function list(array $query = []): array
    {
        return $this->client->postByApp(path: 'users', data: $query)->json();
    }

    public function get(string $userId): array
    {
        return $this->client->postByApp(path: 'users/'.$userId, data: ['user_id' => $userId])->json();
    }

    public function create(string $email, string $phone, array $userMetadata = []): array
    {
        return $this->client->postByApp(path: 'users', data: [
            'email' => $email,
            'phone' => $phone,
            'user_metadata' => $userMetadata,
        ])->json();
    }

    public function import(string $csv): array
    {
        return $this->client->postByApp(path: 'users', data: ['csv' => $csv])->json();
    }

    public function update(string $userId, string $email, string $phone, array $userMetadata = []): array
    {
        return $this->client->postByApp(path: 'users/'.$userId, data: [
            'email' => $email,
            'phone' => $phone,
            'user_metadata' => $userMetadata,
        ])->json();
    }

    public function activate(string $userId): array
    {
        return $this->client->patchByApp(path: \sprintf('users/%s/activate', $userId))->json();
    }

    public function deactivate(string $userId): array
    {
        return $this->client->patchByApp(path: \sprintf('users/%s/deactivate', $userId))->json();
    }

    public function delete(string $userId): array
    {
        return $this->client->deleteByApp(path: 'users/'.$userId)->json();
    }

    public function revokeRefreshTokens(string $userId): array
    {
        return $this->client->deleteByApp(path: \sprintf('users/%s/tokens', $userId))->json();
    }
}
