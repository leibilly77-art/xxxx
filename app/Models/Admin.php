<?php

declare(strict_types=1);

namespace App\Models;

use App\Core\Database;

final class Admin
{
    /**
     * @return array<string, mixed>|null
     */
    public function findByUsername(string $username): ?array
    {
        $statement = Database::connection()->prepare(
            'SELECT id, username, password_hash, nickname, status, last_login_at, created_at, updated_at
             FROM xpay_admins
             WHERE username = :username
             LIMIT 1'
        );
        $statement->execute(['username' => $username]);
        $admin = $statement->fetch();

        return $admin ?: null;
    }

    public function updateLastLoginAt(int $id): void
    {
        $statement = Database::connection()->prepare(
            'UPDATE xpay_admins SET last_login_at = NOW(), updated_at = NOW() WHERE id = :id'
        );
        $statement->execute(['id' => $id]);
    }
}
