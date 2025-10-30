<?php
require dirname(__DIR__) . "/vendor/autoload.php";

use UI\Window;
use UI\Size;
use UI\Controls\Label;
use UI\Controls\Grid;
use UI\UI;

// 1. 初始化应用
UI::init();

// 2. 创建窗口
$win = new Window('Hello Grid', new Size(300, 150), false);

// 3. 创建一个 Grid 实例
$grid = new Grid();

// 推荐：为 Grid 设置内边距，让控件之间有一些呼吸空间
$grid->setPadded(true);

// 4. 创建四个标签控件
$label00 = new Label('(0, 0)');
$label10 = new Label('(1, 0)');
$label01 = new Label('(0, 1)');
$label11 = new Label('(1, 1)');

// 5. 使用 append() 将标签放置到网格中
//    网格布局：append(Control $control, int $left, int $top, int $xspan = 1, int $yspan = 1, 
//                   bool $hexpand = false, int $halign = 0, bool $vexpand = false, int $valign = 0)
//    对齐方式：0=Fill, 1=Start, 2=Center, 3=End
$grid->append($label00, 0, 0, 1, 1, false, 0, false, 0);
$grid->append($label10, 1, 0, 1, 1, false, 0, false, 0);
$grid->append($label01, 0, 1, 1, 1, false, 0, false, 0);
$grid->append($label11, 1, 1, 1, 1, false, 0, false, 0);

// 6. 将 Grid 容器添加到窗口中
$win->setChild($grid);

// 7. 窗口关闭事件
$win->onClose(function ($window) {
    UI::exit();
    return true;
});

// 8. 显示窗口并启动事件循环
$win->show();
UI::run();