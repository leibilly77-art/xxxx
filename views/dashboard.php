<section class="dashboard-grid">
  <?php foreach ($metrics as $item): ?>
    <section class="metric-card is-wide">
      <p class="metric-label"><?= e($item['label']) ?></p>
      <div>
        <div class="metric-value"><?= e($item['value']) ?></div>
        <div class="metric-note">
          <span><?= e($item['note']) ?></span>
          <span class="trend <?= !empty($item['danger']) ? 'is-danger' : '' ?>"><?= e($item['trend']) ?></span>
        </div>
      </div>
    </section>
  <?php endforeach; ?>
</section>

<section class="dashboard-main">
  <div class="panel-card">
    <div class="panel-header">
      <div>
        <h2 class="panel-title">最近订单</h2>
        <p class="panel-description">当前为后台框架阶段的模拟订单数据。</p>
      </div>
      <a class="btn btn-secondary" href="/orders">查看订单</a>
    </div>
    <div class="table-wrap">
      <table class="data-table">
        <thead>
          <tr>
            <th>平台订单号</th>
            <th>商户名称</th>
            <th>支付方式</th>
            <th>订单金额</th>
            <th>订单状态</th>
            <th>创建时间</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($recentOrders as $order): ?>
            <tr>
              <td class="order-no"><?= e($order['no']) ?></td>
              <td><?= e($order['merchant']) ?></td>
              <td><span class="tag tag-info"><?= e($order['method']) ?></span></td>
              <td class="money"><?= e($order['amount']) ?></td>
              <td><span class="tag <?= e($order['statusClass']) ?>"><?= e($order['status']) ?></span></td>
              <td><?= e($order['createdAt']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <aside class="status-card">
    <div class="panel-header">
      <div>
        <h2 class="panel-title">系统状态</h2>
        <p class="panel-description">仅展示占位状态，服务接入后再替换真实数据。</p>
      </div>
    </div>
    <div class="status-list">
      <?php foreach ($systemStatuses as $item): ?>
        <div class="status-row">
          <div class="service-name">
            <span class="service-indicator <?= !empty($item['pending']) ? 'is-pending' : '' ?>" aria-hidden="true"></span>
            <span><?= e($item['name']) ?></span>
          </div>
          <span class="tag <?= e($item['statusClass']) ?>"><?= e($item['status']) ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  </aside>
</section>
