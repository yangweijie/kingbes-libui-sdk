<?php
require dirname(__DIR__) . "/vendor/autoload.php";

use UI\UI;
use UI\Window;
use UI\Size;
use UI\Controls\Label;

// 初始化UI库
UI::init();

// 创建主窗口
$window = new Window("测试窗口", new Size(300, 200), true);
$window->setMargined(true);

// 创建标签
$label = new Label("Hello, UI Library!");

// 设置窗口内容
$window->setChild($label);

// 显示窗口
$window->show();

// 运行应用
UI::run();