<?php

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