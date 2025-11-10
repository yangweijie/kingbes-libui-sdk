<?php

require dirname(__DIR__) . "/vendor/autoload.php";

use UI\UI;
use UI\Window;
use UI\Size;
use UI\Area;
use Kingbes\Libui\Draw;
use Kingbes\Libui\DrawBrushType;
use Kingbes\Libui\DrawFillMode;
use Kingbes\Libui\DrawLineCap;
use Kingbes\Libui\DrawLineJoin;

// 游戏常量
define('GRID_WIDTH', 20);    // 网格宽度
define('GRID_HEIGHT', 20);   // 网格高度
define('BLOCK_SIZE', 25);    // 方块大小(像素)

// 初始化UI库
UI::init();

// 创建窗口
$window = new Window(
    "简单绘图测试",
    new Size(
        GRID_WIDTH * BLOCK_SIZE + 20,
        GRID_HEIGHT * BLOCK_SIZE + 100
    ),
    false
);
$window->setMargin(true);

// 窗口关闭事件
$window->onClose(function ($window) {
    UI::exit();
    return true;
});

// 创建绘图区域
$area = new Area(
    function ($handler, $areaObj, $params) { // 绘图处理程序
        // 绘制背景
        $bgBrush = Draw::createBrush(DrawBrushType::Solid, 0.1, 0.1, 0.1, 1.0);
        $bgPath = Draw::createPath(DrawFillMode::Winding);
        Draw::pathAddRectangle(
            $bgPath,
            0,
            0,
            GRID_WIDTH * BLOCK_SIZE,
            GRID_HEIGHT * BLOCK_SIZE
        );
        Draw::pathEnd($bgPath);
        Draw::fill($params, $bgPath, $bgBrush);

        // 绘制网格线
        $lineBrush = Draw::createBrush(DrawBrushType::Solid, 0.2, 0.2, 0.2, 1.0);
        $linePath = Draw::createPath(DrawFillMode::Winding);

        // 水平线
        for ($y = 0; $y <= GRID_HEIGHT; $y++) {
            Draw::createPathFigure($linePath, 0, $y * BLOCK_SIZE);
            Draw::pathLineTo($linePath, GRID_WIDTH * BLOCK_SIZE, $y * BLOCK_SIZE);
        }

        // 垂直线
        for ($x = 0; $x <= GRID_WIDTH; $x++) {
            Draw::createPathFigure($linePath, $x * BLOCK_SIZE, 0);
            Draw::pathLineTo($linePath, $x * BLOCK_SIZE, GRID_HEIGHT * BLOCK_SIZE);
        }

        Draw::pathEnd($linePath);
        $strokeParams = Draw::createStrokeParams(DrawLineCap::Round, DrawLineJoin::Miter, DrawLineJoin::Miter, 1.0);
        Draw::stroke($params, $linePath, $lineBrush, $strokeParams);

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