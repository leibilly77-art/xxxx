<?php

use App\Core\Auth;

$admin = Auth::user() ?? ['nickname' => '平台管理员', 'username' => 'admin'];
$navGroups = [
    [
        'title' => '控制台',
        'items' => [
            ['key' => 'dashboard', 'title' => '控制台', 'path' => '/dashboard'],
        ],
    ],
    [
        'title' => '交易中心',
        'items' => [
            ['key' => 'orders', 'title' => '订单管理', 'path' => '/orders'],
            ['key' => 'notify-logs', 'title' => '回调日志', 'path' => '/notify-logs'],
            ['key' => 'payment-logs', 'title' => '支付日志', 'path' => '/payment-logs'],
        ],
    ],
    [
        'title' => '商户中心',
        'items' => [
            ['key' => 'merchants', 'title' => '商户管理', 'path' => '/merchants'],
        ],
    ],
    [
        'title' => '支付配置',
        'items' => [
            ['key' => 'channels', 'title' => '支付通道', 'path' => '/channels'],
            ['key' => 'payment-types', 'title' => '支付方式', 'path' => '/payment-types'],
        ],
    ],
    [
        'title' => '系统管理',
        'items' => [
            ['key' => 'settings', 'title' => '系统设置', 'path' => '/settings'],
            ['key' => 'admins', 'title' => '管理员管理', 'path' => '/admins'],
        ],
    ],
];
?>
<!doctype html>
<html lang="zh-CN">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= e($pageTitle ?? '控制台') ?> - XPAY 支付中台</title>
    <link rel="stylesheet" href="/assets/css/styles.css" />
  </head>
  <body>
    <div class="app-shell">
      <aside class="sidebar">
        <div class="brand">
          <div class="brand-mark">XP</div>
          <div>
            <p class="brand-name">XPAY</p>
            <p class="brand-subtitle">支付中台管理后台</p>
          </div>
        </div>
        <nav aria-label="后台菜单">
          <?php foreach ($navGroups as $group): ?>
            <div class="nav-section">
              <p class="nav-section-title"><?= e($group['title']) ?></p>
              <div class="nav-list">
                <?php foreach ($group['items'] as $item): ?>
                  <?php $isActive = ($activeRoute ?? '') === $item['key']; ?>
                  <a
                    class="nav-item <?= $isActive ? 'is-active' : '' ?>"
                    href="<?= e($item['path']) ?>"
                    <?= $isActive ? 'aria-current="page"' : '' ?>
                  >
                    <span class="nav-dot" aria-hidden="true"></span>
                    <span><?= e($item['title']) ?></span>
                  </a>
                <?php endforeach; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </nav>
      </aside>
      <div class="main-panel">
        <header class="topbar">
          <div class="topbar-left">
            <div class="breadcrumb">
              <span>XPAY 后台</span>
              <span class="breadcrumb-separator">/</span>
              <span><?= e($breadcrumbGroup ?? '控制台') ?></span>
            </div>
            <h1 class="page-title"><?= e($pageTitle ?? '控制台') ?></h1>
          </div>
          <div class="topbar-actions">
            <div class="admin-card">
              <span class="avatar">管</span>
              <span class="admin-meta">
                <span class="admin-name"><?= e($admin['nickname']) ?></span>
                <span class="admin-role"><?= e($admin['username']) ?></span>
              </span>
            </div>
            <a class="btn btn-ghost" href="/logout">退出登录</a>
          </div>
        </header>
        <main class="content">
          <?php require $contentView; ?>
        </main>
      </div>
    </div>
    <script src="/assets/js/app.js"></script>
  </body>
</html>
