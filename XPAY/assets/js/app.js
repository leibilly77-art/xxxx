const navGroups = [
  {
    title: "控制台",
    items: [{ key: "dashboard", title: "控制台" }],
  },
  {
    title: "交易中心",
    items: [
      { key: "orders", title: "订单管理" },
      { key: "callbacks", title: "回调日志" },
      { key: "paylogs", title: "支付日志" },
    ],
  },
  {
    title: "商户中心",
    items: [{ key: "merchants", title: "商户管理" }],
  },
  {
    title: "支付配置",
    items: [
      { key: "channels", title: "支付通道" },
      { key: "methods", title: "支付方式" },
    ],
  },
  {
    title: "系统管理",
    items: [
      { key: "settings", title: "系统设置" },
      { key: "admins", title: "管理员管理" },
    ],
  },
];

const pageMeta = {
  dashboard: { title: "控制台", group: "控制台" },
  orders: { title: "订单管理", group: "交易中心" },
  callbacks: { title: "回调日志", group: "交易中心" },
  paylogs: { title: "支付日志", group: "交易中心" },
  merchants: { title: "商户管理", group: "商户中心" },
  channels: { title: "支付通道", group: "支付配置" },
  methods: { title: "支付方式", group: "支付配置" },
  settings: { title: "系统设置", group: "系统管理" },
  admins: { title: "管理员管理", group: "系统管理" },
};

const metrics = [
  { label: "今日交易金额", value: "¥ 128,640.80", note: "模拟统计", trend: "+12.5%" },
  { label: "今日订单数", value: "1,286", note: "模拟统计", trend: "+8.2%" },
  { label: "成功订单数", value: "1,214", note: "模拟统计", trend: "+9.1%" },
  { label: "失败订单数", value: "42", note: "模拟统计", trend: "-3.4%", danger: true },
  { label: "支付成功率", value: "94.4%", note: "模拟统计", trend: "+1.8%" },
  { label: "回调失败数", value: "7", note: "模拟统计", trend: "-2", danger: true },
];

const recentOrders = [
  {
    no: "XP202605020001",
    merchant: "星河便利店",
    method: "支付宝",
    amount: "¥ 268.00",
    status: "支付成功",
    statusClass: "tag-success",
    createdAt: "2026-05-02 10:21:36",
  },
  {
    no: "XP202605020002",
    merchant: "云启生活服务",
    method: "微信支付",
    amount: "¥ 89.90",
    status: "支付成功",
    statusClass: "tag-success",
    createdAt: "2026-05-02 10:18:09",
  },
  {
    no: "XP202605020003",
    merchant: "蓝湾餐饮",
    method: "支付宝",
    amount: "¥ 1,299.00",
    status: "处理中",
    statusClass: "tag-warning",
    createdAt: "2026-05-02 10:12:45",
  },
  {
    no: "XP202605020004",
    merchant: "悦动会员中心",
    method: "微信支付",
    amount: "¥ 39.00",
    status: "支付失败",
    statusClass: "tag-danger",
    createdAt: "2026-05-02 10:05:18",
  },
  {
    no: "XP202605020005",
    merchant: "北辰数码",
    method: "支付宝",
    amount: "¥ 4,580.00",
    status: "支付成功",
    statusClass: "tag-success",
    createdAt: "2026-05-02 09:58:31",
  },
];

const systemStatuses = [
  { name: "支付服务", status: "正常", statusClass: "tag-success" },
  { name: "回调服务", status: "正常", statusClass: "tag-success" },
  { name: "数据库", status: "正常", statusClass: "tag-success" },
  { name: "队列服务", status: "待接入", statusClass: "tag-warning", pending: true },
];

const placeholderTips = {
  orders: "后续会在这里承载统一订单查询、订单状态筛选和订单明细入口。",
  callbacks: "后续会在这里展示商户回调投递记录、重试状态和错误摘要。",
  paylogs: "后续会在这里记录支付请求链路、通道响应和排查信息。",
  merchants: "后续会在这里维护商户资料、应用标识和基础接入状态。",
  channels: "后续会在这里配置支付宝、微信支付等通道资料的管理入口。",
  methods: "后续会在这里管理面向商户开放的支付方式和展示状态。",
  settings: "后续会在这里维护平台基础配置、通知策略和安全设置。",
  admins: "后续会在这里维护后台管理员账号、角色和权限分配。",
};

const app = document.querySelector("#app");

function escapeHtml(value) {
  return String(value)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;");
}

function getRoute() {
  const route = window.location.hash.replace("#/", "").replace("#", "") || "login";
  if (route === "login") {
    return "login";
  }
  return pageMeta[route] ? route : "dashboard";
}

function navigate(route) {
  window.location.hash = route === "login" ? "#login" : `#/${route}`;
}

function renderLogin() {
  app.innerHTML = `
    <main class="login-page">
      <section class="login-hero" aria-label="XPAY 产品介绍">
        <div class="login-badge">XPAY Admin Preview</div>
        <h1 class="login-title">XPAY 支付中台后台框架</h1>
        <p class="login-copy">
          当前阶段仅提供后台登录占位、主布局、控制台首页和各业务模块占位页。所有交易、订单和系统状态均为模拟展示数据。
        </p>
        <div class="login-highlights">
          <div class="highlight-item">
            <div class="highlight-value">UI</div>
            <div class="highlight-label">后台基础框架</div>
          </div>
          <div class="highlight-item">
            <div class="highlight-value">Mock</div>
            <div class="highlight-label">模拟运营数据</div>
          </div>
          <div class="highlight-item">
            <div class="highlight-value">Shell</div>
            <div class="highlight-label">业务页面占位</div>
          </div>
        </div>
      </section>
      <section class="login-side" aria-label="后台登录">
        <div class="login-card">
          <h1>后台登录</h1>
          <p>这是登录页占位，暂未接入真实认证。点击演示入口可进入后台布局。</p>
          <div class="form-group">
            <label for="username">管理员账号</label>
            <input id="username" value="admin@xpay.local" disabled />
          </div>
          <div class="form-group">
            <label for="password">登录密码</label>
            <input id="password" value="********" type="password" disabled />
          </div>
          <div class="login-actions">
            <button class="btn btn-primary" type="button" data-route="dashboard">进入后台演示</button>
            <button class="btn btn-secondary" type="button" disabled>真实登录待接入</button>
          </div>
          <div class="login-note">
            本阶段不连接支付宝、微信支付或任何真实支付服务，也不包含下单、回调、余额、提现、代付和清算功能。
          </div>
        </div>
      </section>
    </main>
  `;
}

function renderSidebar(activeRoute) {
  const groups = navGroups
    .map((group) => {
      const items = group.items
        .map(
          (item) => `
            <button class="nav-item ${item.key === activeRoute ? "is-active" : ""}" type="button" data-route="${item.key}">
              <span class="nav-dot" aria-hidden="true"></span>
              <span>${escapeHtml(item.title)}</span>
            </button>
          `,
        )
        .join("");

      return `
        <div class="nav-section">
          <p class="nav-section-title">${escapeHtml(group.title)}</p>
          <div class="nav-list">${items}</div>
        </div>
      `;
    })
    .join("");

  return `
    <aside class="sidebar">
      <div class="brand">
        <div class="brand-mark">XP</div>
        <div>
          <p class="brand-name">XPAY</p>
          <p class="brand-subtitle">支付中台管理后台</p>
        </div>
      </div>
      <nav aria-label="后台菜单">${groups}</nav>
    </aside>
  `;
}

function renderTopbar(route) {
  const meta = pageMeta[route];

  return `
    <header class="topbar">
      <div class="topbar-left">
        <div class="breadcrumb">
          <span>XPAY 后台</span>
          <span class="breadcrumb-separator">/</span>
          <span>${escapeHtml(meta.group)}</span>
        </div>
        <h1 class="page-title">${escapeHtml(meta.title)}</h1>
      </div>
      <div class="topbar-actions">
        <div class="admin-card">
          <span class="avatar">管</span>
          <span class="admin-meta">
            <span class="admin-name">平台管理员</span>
            <span class="admin-role">admin@xpay.local</span>
          </span>
        </div>
        <button class="btn btn-ghost" type="button" data-route="login">退出登录</button>
      </div>
    </header>
  `;
}

function renderDashboard() {
  const metricCards = metrics
    .map(
      (item) => `
        <section class="metric-card is-wide">
          <p class="metric-label">${escapeHtml(item.label)}</p>
          <div>
            <div class="metric-value">${escapeHtml(item.value)}</div>
            <div class="metric-note">
              <span>${escapeHtml(item.note)}</span>
              <span class="trend ${item.danger ? "is-danger" : ""}">${escapeHtml(item.trend)}</span>
            </div>
          </div>
        </section>
      `,
    )
    .join("");

  const rows = recentOrders
    .map(
      (order) => `
        <tr>
          <td class="order-no">${escapeHtml(order.no)}</td>
          <td>${escapeHtml(order.merchant)}</td>
          <td><span class="tag tag-info">${escapeHtml(order.method)}</span></td>
          <td class="money">${escapeHtml(order.amount)}</td>
          <td><span class="tag ${order.statusClass}">${escapeHtml(order.status)}</span></td>
          <td>${escapeHtml(order.createdAt)}</td>
        </tr>
      `,
    )
    .join("");

  const statusRows = systemStatuses
    .map(
      (item) => `
        <div class="status-row">
          <div class="service-name">
            <span class="service-indicator ${item.pending ? "is-pending" : ""}" aria-hidden="true"></span>
            <span>${escapeHtml(item.name)}</span>
          </div>
          <span class="tag ${item.statusClass}">${escapeHtml(item.status)}</span>
        </div>
      `,
    )
    .join("");

  return `
    <section class="dashboard-grid">${metricCards}</section>
    <section class="dashboard-main">
      <div class="panel-card">
        <div class="panel-header">
          <div>
            <h2 class="panel-title">最近订单</h2>
            <p class="panel-description">当前为后台框架阶段的模拟订单数据。</p>
          </div>
          <button class="btn btn-secondary" type="button" data-route="orders">查看订单</button>
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
            <tbody>${rows}</tbody>
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
        <div class="status-list">${statusRows}</div>
      </aside>
    </section>
  `;
}

function renderPlaceholder(route) {
  const meta = pageMeta[route];
  return `
    <section class="placeholder-card">
      <div class="panel-header">
        <div>
          <h2 class="panel-title">${escapeHtml(meta.title)}</h2>
          <p class="panel-description">统一后台卡片布局，占位页面保持与控制台一致的视觉风格。</p>
        </div>
        <button class="btn btn-secondary" type="button" disabled>功能待接入</button>
      </div>
      <div class="empty-state">
        <div>
          <div class="empty-icon" aria-hidden="true">XP</div>
          <h3 class="empty-title">${escapeHtml(meta.title)}暂无数据</h3>
          <p class="empty-desc">
            ${escapeHtml(placeholderTips[route])}
            当前阶段仅搭建后台框架和 UI，不包含真实支付、回调或资金相关逻辑。
          </p>
        </div>
      </div>
    </section>
  `;
}

function renderShell(route) {
  const page = route === "dashboard" ? renderDashboard() : renderPlaceholder(route);
  app.innerHTML = `
    <div class="app-shell">
      ${renderSidebar(route)}
      <div class="main-panel">
        ${renderTopbar(route)}
        <main class="content">${page}</main>
      </div>
    </div>
  `;
}

function render() {
  const route = getRoute();
  if (route === "login") {
    renderLogin();
    return;
  }
  renderShell(route);
}

app.addEventListener("click", (event) => {
  const target = event.target.closest("[data-route]");
  if (!target || target.disabled) {
    return;
  }
  navigate(target.dataset.route);
});

window.addEventListener("hashchange", render);
render();
