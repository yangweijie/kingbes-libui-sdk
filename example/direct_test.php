<?php
require dirname(__DIR__) . "/vendor/autoload.php";

use Kingbes\Libui\App;
use Kingbes\Libui\Window;
use Kingbes\Libui\Control;
use Kingbes\Libui\Label;

// 初始化应用
App::init();

// 创建窗口
$window = Window::create("测试窗口", 300, 200, 1);
Window::setMargined($window, true);

// 创建标签
$label = Label::create("Hello, Kingbes Libui!");

// 设置窗口内容
Window::setChild($window, $label);

// 显示窗口
Control::show($window);

// 运行应用
App::main();