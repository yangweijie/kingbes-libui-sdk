# Kingbes LibUI SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/yangweijie/kingbes-libui-sdk.svg?style=flat-square)](https://packagist.org/packages/yangweijie/kingbes-libui-sdk)
[![Total Downloads](https://img.shields.io/packagist/dt/yangweijie/kingbes-libui-sdk.svg?style=flat-square)](https://packagist.org/packages/yangweijie/kingbes-libui-sdk)

这是一个基于 [kingbes/libui](https://github.com/kingbes/libui) 的 PHP GUI 开发工具包，提供了面向对象的 API，让 PHP 开发者能够更方便地创建桌面应用程序。

## 安装

使用 Composer 安装:

```bash
composer require yangweijie/kingbes-libui-sdk
```

## 环境要求

- PHP 8.0+
- kingbes/libui 扩展 (请参考其安装说明)

## 快速开始

创建一个简单的应用程序:

```php
<?php

require_once 'vendor/autoload.php';

use Kingbes\Libui\SDK\LibuiApplication;
use Kingbes\Libui\SDK\LibuiWindow;
use Kingbes\Libui\SDK\LibuiButton;

// 初始化应用
$app = LibuiApplication::getInstance();
$app->init();

// 创建窗口
$window = $app->createWindow("Hello World", 300, 200);

// 创建按钮
$button = new LibuiButton("Click Me");

// 绑定按钮点击事件
$button->onClick(function() {
    echo "Button clicked!\n";
});

// 将按钮添加到窗口并显示
$window->setChild($button)->show();

// 运行应用
$app->run();
```

## 核心概念

### LibuiApplication
应用程序的入口点和核心管理器，使用单例模式。

### LibuiComponent
所有 UI 组件的基类，提供了组件树管理、事件处理和资源清理功能。

### EventManager
统一的事件管理器，用于处理组件间通信。

## 支持的组件

- 窗口 (Window)
- 按钮 (Button)
- 文本框 (Entry)
- 多行文本框 (MultilineEntry)
- 复选框 (Checkbox)
- 单选框 (Radio)
- 组合框 (Combobox)
- 可编辑组合框 (EditableCombobox)
- 微调器 (Spinbox)
- 滑块 (Slider)
- 进度条 (ProgressBar)
- 日期时间选择器 (DateTimePicker)
- 表格 (Table)
- 选项卡 (Tab)
- 绘图区域 (DrawArea)
- 布局容器 (HBox, VBox, Grid, Form, Group)

## 事件系统

SDK 使用统一的事件管理器来处理组件事件。每个组件都可以通过 `on` 方法监听事件，也可以使用便捷方法如 `onClick`。

```php
$button->on('button.clicked', function($source, $data) {
    // 处理按钮点击事件
});

// 或者使用便捷方法
$button->onClick(function() {
    // 处理按钮点击事件
});
```

## 许可证

MIT License. 详见 [LICENSE](LICENSE) 文件。