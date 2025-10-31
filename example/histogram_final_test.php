<?php

require dirname(__DIR__) . "/vendor/autoload.php";

use UI\UI;
use UI\Window;
use UI\Size;
use UI\Area;
use Kingbes\Libui\Draw;
use Kingbes\Libui\DrawBrushType;
use Kingbes\Libui\DrawFillMode;

// 初始化UI库
UI::init();

// 创建主窗口
$window = new Window("最终测试", new Size(400, 300), false);
$window->setMargin(true);

// 窗口关闭事件
$window->onClose(function ($window) {
    UI::exit();
    return true;
});

// 创建绘图区域
$area = new Area(
    function ($h, $a, $params) { // 绘图处理程序
        // 直接使用$params参数进行绘图
        // 填充背景为白色
        $whiteBrush = Draw::createBrush(DrawBrushType::Solid, 1.0, 1.0, 1.0, 1.0);
        $bgPath = Draw::createPath(DrawFillMode::Winding);
        Draw::pathAddRectangle($bgPath, 0, 0, 400, 300);
        Draw::pathEnd($bgPath);
        Draw::fill($params, $bgPath, $whiteBrush);
        
        // 绘制一个简单的蓝色矩形
        $blueBrush = Draw::createBrush(DrawBrushType::Solid, 0.0, 0.0, 1.0, 1.0);
        $rectPath = Draw::createPath(DrawFillMode::Winding);
        Draw::pathAddRectangle($rectPath, 50, 50, 100, 100);
        Draw::pathEnd($rectPath);
        Draw::fill($params, $rectPath, $blueBrush);
    }
);

// 设置窗口内容
$window->setChild($area);

// 显示窗口
$window->show();

// 运行应用
UI::run();