<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Services\AuthService;
use Throwable;

final class AuthController extends Controller
{
    public function showLogin(): void
    {
        if (Auth::check()) {
            redirect('/dashboard');
        }

        $this->render('login', [
            'error' => null,
            'oldUsername' => '',
        ]);
    }

    public function login(): void
    {
        if (Auth::check()) {
            redirect('/dashboard');
        }

        $username = (string) ($_POST['username'] ?? '');
        $password = (string) ($_POST['password'] ?? '');

        try {
            $admin = (new AuthService())->attempt($username, $password);
        } catch (Throwable) {
            $this->render('login', [
                'error' => '数据库连接失败，请检查数据库配置和 xpay_admins 表是否已导入。',
                'oldUsername' => $username,
            ]);
            return;
        }

        if ($admin === null) {
            $this->render('login', [
                'error' => '账号或密码错误，或管理员账号已被停用。',
                'oldUsername' => $username,
            ]);
            return;
        }

        Auth::login($admin);
        redirect('/dashboard');
    }

    public function logout(): void
    {
        Auth::logout();
        redirect('/login');
    }
}
