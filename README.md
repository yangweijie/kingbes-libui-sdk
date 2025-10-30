# UI

这是一个对 [kingbes/libui](https://github.com/kingbes/php-libui) 的面向对象封装，提供了更符合 PHP 习惯的 API，灵感来源于 [PHP 官方的 UI 扩展](https://www.php.net/manual/zh/book.ui.php)。

## 安装

```bash
composer require yangweijie/ui
```

## 使用示例

### 简单按钮示例

```php
// example/button.php

require dirname(__DIR__) . "/vendor/autoload.php";

use UI\UI;
use UI\Window;
use UI\Size;
use UI\Controls\Box;
use UI\Controls\Orientation;
use UI\Controls\Button;

// 初始化应用
UI::init();

// 创建窗口
$window = new Window("窗口", new Size(640, 480), false);
// 窗口设置边框
$window->setMargin(true);

// 窗口关闭事件
$window->onClose(function ($window) {
    echo "窗口关闭\n";
    // 退出应用
    UI::exit();
    // 返回 true：关闭窗口, false：不关闭
    return true;
});

// 创建垂直容器
$box = new Box(Orientation::Vertical);
$box->setPadded(true); // 设置边距
$window->setChild($box); // 设置窗口子元素

// 创建按钮
$btn01 = new Button("按钮");
// 按钮点击事件
$btn01->onClick(function ($btn01) use ($window) {
    echo "按钮点击\n";
    $window->msgBox("提示", "世界上最好的语言PHP~");
});
// 追加按钮到容器
$box->append($btn01, false);

// 显示窗口
$window->show();

// 启动主循环
UI::run();
```

运行示例：

```bash
php example/button.php
```

## 测试

本项目使用 Pest 作为测试框架。要运行测试，请执行以下命令：

```bash
# 运行所有测试
php run_pest_tests.php

# 或者使用 PHPUnit（如果配置正确）
./vendor/bin/phpunit
```

## API 设计

本库的 API 设计尽可能贴近 PHP 官方 UI 扩展的接口，方便开发者学习和使用。

核心类包括：

- `UI\UI`: UI 入口。
- `UI\Window`: 窗口控件。
- `UI\Size`: 用于表示尺寸。
- `UI\Control`: 所有控件的基类。
- `UI\Controls\Box`: 布局容器。
- `UI\Controls\Button`: 按钮控件。
- `UI\Draw\Brush`: 画笔基类。
- `UI\Draw\Brush\Gradient`: 渐变画笔基类。
- `UI\Draw\Brush\LinearGradient`: 线性渐变画笔。
- `UI\Draw\Brush\RadialGradient`: 径向渐变画笔。
- 更多控件正在封装中...

## 依赖

- PHP 8.2+
- [kingbes/libui](https://github.com/kingbes/php-libui)