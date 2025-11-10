<?php
require dirname(__DIR__) . "/vendor/autoload.php";

use UI\UI;
use UI\Window;
use UI\Size;
use UI\Area;

// 初始化UI库
UI::init();

// 创建主窗口
$window = new Window("Area 测试", new Size(400, 300), true);
$window->setMargined(true);

// 创建绘图区域
$area = new Area(
    function ($area, $params) { // 绘图处理程序
        echo "绘图区域已创建\n";
    }
);

// 设置窗口内容
$window->setChild($area);

// 显示窗口
$window->show();

// 运行应用
UI::run();