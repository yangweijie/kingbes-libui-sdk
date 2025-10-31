<?php
require dirname(__DIR__) . "/vendor/autoload.php";

use UI\UI;
use UI\Window;
use UI\Size;
use UI\Controls\Group;
use UI\Controls\Button;
use UI\Controls\Box;
use UI\Controls\Orientation;

// 初始化UI库
UI::init();

// 创建窗口
$window = new Window("Group Example", new Size(640, 480));
// 窗口设置边框
$window->setMargin(true);

// 创建组
$group = new Group("Group");
// 组设置边框
$group->setMargin(true);

// 创建盒子
$box = new Box(Orientation::Vertical);
// 盒子添加按钮
$box->append(new Button("Button"), false);

// 组添加按钮
$group->setChild($box);
// 设置窗口子元素
$window->setChild($group);

// 窗口关闭事件
$window->onClose(function ($window) {
    UI::exit();
    return true;
});

// 显示窗口
$window->show();

// 运行应用
UI::run();