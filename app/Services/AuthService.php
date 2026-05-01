<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Admin;

final class AuthService
{
    public function __construct(private readonly Admin $admins = new Admin())
    {
    }

    /**
     * @return array<string, mixed>|null
     */
    public function attempt(string $username, string $password): ?array
    {
        $username = trim($username);

        if ($username === '' || $password === '') {
            return null;
        }

        $admin = $this->admins->findByUsername($username);

        if ($admin === null || (int) $admin['status'] !== 1) {
            return null;
        }

        if (!password_verify($password, $admin['password_hash'])) {
            return null;
        }

        $this->admins->updateLastLoginAt((int) $admin['id']);

        return $admin;
    }
}
