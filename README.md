# XPAY 支付中台

XPAY 是面向支付宝和微信支付的支付中台，目标是统一下单、统一订单管理、统一回调、统一补单、统一支付配置和统一统计。

本项目不做资金池、余额提现、人工代付、二清和无牌清算。

## 当前阶段

第二阶段：PHP 后端基础框架 + 管理员登录。

当前只包含：

- 原生 PHP 路由入口
- 管理员登录与退出
- PHP session 登录状态
- 未登录后台页面自动跳转 `/login`
- 后台主布局、控制台和占位页面
- `xpay_admins` 管理员表结构

当前不包含：

- 支付宝官方接口接入
- 微信支付官方接口接入
- 真实下单
- 真实回调
- 余额、提现、代付、资金清算

## 目录结构

```text
public/
  index.php
  assets/
    css/styles.css
    js/app.js
app/
  Controllers/
  Core/
  Models/
  Services/
config/
  database.php
database/
  schema.sql
views/
  login.php
  layout.php
  dashboard.php
  empty.php
```

## 配置数据库

默认读取以下环境变量；未设置时使用括号内默认值：

- `XPAY_DB_HOST` (`127.0.0.1`)
- `XPAY_DB_PORT` (`3306`)
- `XPAY_DB_DATABASE` (`xpay`)
- `XPAY_DB_USERNAME` (`root`)
- `XPAY_DB_PASSWORD` (空)
- `XPAY_DB_CHARSET` (`utf8mb4`)

也可以直接修改 `config/database.php`。

## 导入 SQL

先创建数据库：

```sql
CREATE DATABASE xpay DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

再导入表结构和默认管理员：

```powershell
mysql -u root -p xpay < database/schema.sql
```

`database/schema.sql` 中默认管理员密码只保存 hash，不保存明文密码。

## 启动项目

在项目根目录执行：

```powershell
php -S 127.0.0.1:8000 -t public public/index.php
```

访问：

```text
http://127.0.0.1:8000/login
```

## 默认后台账号

- 用户名：`admin`
- 密码：`xpay123456`

## 当前可测试功能

1. 未登录访问 `http://127.0.0.1:8000/dashboard`，应自动跳转到 `/login`。
2. 使用默认账号登录，成功后应跳转 `/dashboard`。
3. 点击顶部“退出登录”，应退出 session 并跳转 `/login`。
4. 登录后访问左侧菜单页面，应显示统一后台布局和空数据提示。

## 后续开发计划

- 管理员列表与账号管理
- 商户管理基础 CRUD
- 订单查询页面基础筛选
- 支付通道与支付方式配置页
- 后续明确任务后，再参考官方文档接入支付宝和微信支付逻辑
