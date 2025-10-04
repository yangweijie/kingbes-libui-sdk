# 项目概述

这是一个 PHP 库，名为 `yangweijie/kingbes-libuui-sdk`，它是对 `kingbes/libui` 的面向对象封装。该项目提供了一套易于使用的 PHP 类来创建和管理桌面 GUI 应用程序，基于 libui 库。

## 核心概念

- **LibuiApplication**: 应用程序的入口点和核心管理器，使用单例模式。
- **LibuiComponent**: 所有 UI 组件的基类，提供了组件树管理、事件处理和资源清理功能。
- **EventManager**: 统一的事件管理器，用于处理组件间通信。
- **窗口管理**: 提供多种窗口类型，如普通窗口、确认对话框、浏览器窗口和保存文件对话框。

## 主要特性

- 面向对象的 API 设计
- 事件驱动的编程模型
- 支持多种 UI 组件（按钮、文本框、组合框等）
- 跨平台剪贴板操作
- 屏幕信息获取
- 窗口定位和管理

# 项目结构

```
kingbes-libui-sdk/
├── src/
│   ├── Enums/
│   ├── LibuiApplication.php
│   ├── LibuiComponent.php
│   ├── LibuiWindow.php
│   ├── EventManager.php
│   ├── LibuiButton.php
│   └── ... (其他组件)
├── vendor/
└── composer.json
```

# 开发约定

- 使用 PSR-4 自动加载标准
- 所有类都位于 `Kingbes\Libui\SDK` 命名空间下
- 组件继承自 `LibuiComponent` 基类
- 事件处理通过 `EventManager` 统一管理
- 使用单例模式管理应用程序实例

# 构建和运行

由于这是一个 PHP 库，不需要传统的构建过程。使用时需要通过 Composer 安装依赖。

```bash
composer install
```

要运行一个简单的示例，可以创建一个 PHP 文件并包含自动加载器：

```php
require_once 'vendor/autoload.php';

use Kingbes\Libui\SDK\LibuiApplication;
use Kingbes\Libui\SDK\LibuiWindow;
use Kingbes\Libui\SDK\LibuiButton;

$app = LibuiApplication::getInstance();
$app->init();

$window = $app->createWindow("Hello World", 300, 200);
$button = new LibuiButton("Click Me");

$button->onClick(function() {
    echo "Button clicked!\n";
});

$window->setChild($button)->show();

$app->run();
```