<?php

declare(strict_types=1);

namespace App\Core;

final class Auth
{
    public static function check(): bool
    {
        return isset($_SESSION['admin']) && is_array($_SESSION['admin']);
    }

    /**
     * @return array<string, mixed>|null
     */
    public static function user(): ?array
    {
        return self::check() ? $_SESSION['admin'] : null;
    }

    /**
     * @param array<string, mixed> $admin
     */
    public static function login(array $admin): void
    {
        session_regenerate_id(true);

        $_SESSION['admin'] = [
            'id' => $admin['id'],
            'username' => $admin['username'],
            'nickname' => $admin['nickname'] ?: $admin['username'],
        ];
    }

    public static function logout(): void
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
    }
}
