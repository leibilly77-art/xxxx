<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Controller;

final class DashboardController extends Controller
{
    /**
     * @var array<string, array{title: string, group: string, tip: string}>
     */
    private array $pages = [
        'orders' => [
            'title' => '订单管理',
            'group' => '交易中心',
            'tip' => '后续会在这里承载统一订单查询、订单状态筛选和订单明细入口。',
        ],
        'notify-logs' => [
            'title' => '回调日志',
            'group' => '交易中心',
            'tip' => '后续会在这里展示商户回调投递记录、重试状态和错误摘要。',
        ],
        'payment-logs' => [
            'title' => '支付日志',
            'group' => '交易中心',
            'tip' => '后续会在这里记录支付请求链路、通道响应和排查信息。',
        ],
        'merchants' => [
            'title' => '商户管理',
            'group' => '商户中心',
            'tip' => '后续会在这里维护商户资料、应用标识和基础接入状态。',
        ],
        'channels' => [
            'title' => '支付通道',
            'group' => '支付配置',
            'tip' => '后续会在这里配置支付宝、微信支付等通道资料的管理入口。',
        ],
        'payment-types' => [
            'title' => '支付方式',
            'group' => '支付配置',
            'tip' => '后续会在这里管理面向商户开放的支付方式和展示状态。',
        ],
        'settings' => [
            'title' => '系统设置',
            'group' => '系统管理',
            'tip' => '后续会在这里维护平台基础配置、通知策略和安全设置。',
        ],
        'admins' => [
            'title' => '管理员管理',
            'group' => '系统管理',
            'tip' => '后续会在这里维护后台管理员账号、角色和权限分配。',
        ],
    ];

    public function dashboard(): void
    {
        $this->requireLogin();

        $this->renderLayout('dashboard', [
            'pageTitle' => '控制台',
            'breadcrumbGroup' => '控制台',
            'activeRoute' => 'dashboard',
            'metrics' => $this->metrics(),
            'recentOrders' => $this->recentOrders(),
            'systemStatuses' => $this->systemStatuses(),
        ]);
    }

    public function emptyPage(string $key): void
    {
        $this->requireLogin();

        if (!isset($this->pages[$key])) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }

        $page = $this->pages[$key];

        $this->renderLayout('empty', [
            'pageTitle' => $page['title'],
            'breadcrumbGroup' => $page['group'],
            'activeRoute' => $key,
            'emptyTip' => $page['tip'],
        ]);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function metrics(): array
    {
        return [
            ['label' => '今日交易金额', 'value' => '¥ 128,640.80', 'note' => '模拟统计', 'trend' => '+12.5%'],
            ['label' => '今日订单数', 'value' => '1,286', 'note' => '模拟统计', 'trend' => '+8.2%'],
            ['label' => '成功订单数', 'value' => '1,214', 'note' => '模拟统计', 'trend' => '+9.1%'],
            ['label' => '失败订单数', 'value' => '42', 'note' => '模拟统计', 'trend' => '-3.4%', 'danger' => true],
            ['label' => '支付成功率', 'value' => '94.4%', 'note' => '模拟统计', 'trend' => '+1.8%'],
            ['label' => '回调失败数', 'value' => '7', 'note' => '模拟统计', 'trend' => '-2', 'danger' => true],
        ];
    }

    /**
     * @return array<int, array<string, string>>
     */
    private function recentOrders(): array
    {
        return [
            ['no' => 'XP202605020001', 'merchant' => '星河便利店', 'method' => '支付宝', 'amount' => '¥ 268.00', 'status' => '支付成功', 'statusClass' => 'tag-success', 'createdAt' => '2026-05-02 10:21:36'],
            ['no' => 'XP202605020002', 'merchant' => '云启生活服务', 'method' => '微信支付', 'amount' => '¥ 89.90', 'status' => '支付成功', 'statusClass' => 'tag-success', 'createdAt' => '2026-05-02 10:18:09'],
            ['no' => 'XP202605020003', 'merchant' => '蓝湾餐饮', 'method' => '支付宝', 'amount' => '¥ 1,299.00', 'status' => '处理中', 'statusClass' => 'tag-warning', 'createdAt' => '2026-05-02 10:12:45'],
            ['no' => 'XP202605020004', 'merchant' => '悦动会员中心', 'method' => '微信支付', 'amount' => '¥ 39.00', 'status' => '支付失败', 'statusClass' => 'tag-danger', 'createdAt' => '2026-05-02 10:05:18'],
            ['no' => 'XP202605020005', 'merchant' => '北辰数码', 'method' => '支付宝', 'amount' => '¥ 4,580.00', 'status' => '支付成功', 'statusClass' => 'tag-success', 'createdAt' => '2026-05-02 09:58:31'],
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    private function systemStatuses(): array
    {
        return [
            ['name' => '支付服务', 'status' => '正常', 'statusClass' => 'tag-success'],
            ['name' => '回调服务', 'status' => '正常', 'statusClass' => 'tag-success'],
            ['name' => '数据库', 'status' => '正常', 'statusClass' => 'tag-success'],
            ['name' => '队列服务', 'status' => '待接入', 'statusClass' => 'tag-warning', 'pending' => true],
        ];
    }
}
