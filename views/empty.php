<section class="placeholder-card">
  <div class="panel-header">
    <div>
      <h2 class="panel-title"><?= e($pageTitle ?? '占位页面') ?></h2>
      <p class="panel-description">统一后台卡片布局，占位页面保持与控制台一致的视觉风格。</p>
    </div>
    <button class="btn btn-secondary" type="button" disabled>功能待接入</button>
  </div>
  <div class="empty-state">
    <div>
      <div class="empty-icon" aria-hidden="true">XP</div>
      <h3 class="empty-title"><?= e($pageTitle ?? '页面') ?>暂无数据</h3>
      <p class="empty-desc">
        <?= e($emptyTip ?? '后续会在这里接入具体业务功能。') ?>
        当前阶段仅搭建 PHP 后端基础框架和管理员登录，不包含真实支付、回调或资金相关逻辑。
      </p>
    </div>
  </div>
</section>
