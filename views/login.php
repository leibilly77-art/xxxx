<!doctype html>
<html lang="zh-CN">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>后台登录 - XPAY 支付中台</title>
    <link rel="stylesheet" href="/assets/css/styles.css" />
  </head>
  <body>
    <main class="login-page">
      <section class="login-hero" aria-label="XPAY 产品介绍">
        <div class="login-badge">XPAY Admin Console</div>
        <h1 class="login-title">XPAY 支付中台后台框架</h1>
        <p class="login-copy">
          当前阶段提供 PHP 后端基础框架、管理员登录、会话保持、路由保护和后台页面占位。所有交易、订单和系统状态均为模拟展示数据。
        </p>
        <div class="login-highlights">
          <div class="highlight-item">
            <div class="highlight-value">PHP</div>
            <div class="highlight-label">基础后端框架</div>
          </div>
          <div class="highlight-item">
            <div class="highlight-value">Session</div>
            <div class="highlight-label">管理员登录状态</div>
          </div>
          <div class="highlight-item">
            <div class="highlight-value">Mock</div>
            <div class="highlight-label">后台模拟数据</div>
          </div>
        </div>
      </section>
      <section class="login-side" aria-label="后台登录">
        <div class="login-card">
          <h1>后台登录</h1>
          <p>请输入管理员账号密码。当前阶段仅接入本地管理员表，不连接任何真实支付服务。</p>

          <?php if (!empty($error)): ?>
            <div class="alert-error" role="alert"><?= e($error) ?></div>
          <?php endif; ?>

          <form action="/login" method="post" data-login-form>
            <div class="form-group">
              <label for="username">管理员账号</label>
              <input id="username" name="username" value="<?= e($oldUsername ?? '') ?>" autocomplete="username" required autofocus />
            </div>
            <div class="form-group">
              <label for="password">登录密码</label>
              <input id="password" name="password" type="password" autocomplete="current-password" required />
            </div>
            <div class="login-actions">
              <button class="btn btn-primary" type="submit">登录后台</button>
            </div>
          </form>

          <div class="login-note">
            本阶段不连接支付宝、微信支付或任何真实支付服务，也不包含下单、回调、余额、提现、代付和清算功能。
          </div>
        </div>
      </section>
    </main>
    <script src="/assets/js/app.js"></script>
  </body>
</html>
