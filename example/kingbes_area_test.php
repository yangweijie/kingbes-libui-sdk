<?php
require dirname(__DIR__) . "/vendor/autoload.php";

use Kingbes\Libui\App;
use Kingbes\Libui\Window;
use Kingbes\Libui\Control;
use Kingbes\Libui\Area;

// 初始化应用
App::init();

// 创建窗口
$window = Window::create("Area 测试", 400, 300, 1);
Window::setMargined($window, true);

// 创建绘图区域处理程序
$areaHandler = Area::handler(
    function ($handler, $area, $params) { // 绘图处理程序
        echo "绘图区域已创建\n";
    }
);

// 创建绘图区域
$area = Area::create($areaHandler);

// 设置窗口内容
Window::setChild($window, $area);

// 显示窗口
Control::show($window);

// 运行应用
App::main();