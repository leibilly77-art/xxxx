<?php

declare(strict_types=1);

namespace App\Core;

abstract class Controller
{
    protected function requireLogin(): void
    {
        if (!Auth::check()) {
            redirect('/login');
        }
    }

    /**
     * @param array<string, mixed> $data
     */
    protected function render(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        require XPAY_ROOT . '/views/' . $view . '.php';
    }

    /**
     * @param array<string, mixed> $data
     */
    protected function renderLayout(string $view, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        $contentView = XPAY_ROOT . '/views/' . $view . '.php';

        require XPAY_ROOT . '/views/layout.php';
    }
}
