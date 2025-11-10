<?php
require dirname(__DIR__) . "/vendor/autoload.php";

use UI\Window;
use UI\Size;
use UI\Controls\Grid;
use UI\Controls\Box;
use UI\Controls\Orientation;
use UI\Controls\Label;
use UI\Controls\Button;
use UI\UI;

// 初始化应用
UI::init();

// 创建窗口
$win = new Window('仪表盘布局', new Size(600, 400), false);
$grid = new Grid();
$grid->setPadded(true);

// --- 1. 左侧导航区 (使用垂直 Box) ---
$navBox = new Box(Orientation::Vertical);
$navBox->setPadded(true);
$navBox->append(new Button('仪表盘'));
$navBox->append(new Button('用户管理'));
$navBox->append(new Button('系统设置'));
$navBox->append(new Button('数据分析'), true); // 拉伸最后一个按钮

// --- 2. 顶部信息区 ---
$infoLabel = new Label('欢迎使用仪表盘系统');
$logoutBtn = new Button('退出');

// --- 3. 主内容区 ---
$contentLabel = new Label('这里是主要内容区域');

// --- 4. 状态栏 ---
$statusLabel = new Label('状态：在线');

// --- 使用 Grid 布局 ---
// append(Control $control, int $left, int $top, int $xspan = 1, int $yspan = 1, 
//        bool $hexpand = false, int $halign = 0, bool $vexpand = false, int $valign = 0)

// 左侧导航区 (占据第0列，第0-1行，垂直跨2行)
$grid->append($navBox, 0, 0, 1, 2, false, 0, true, 0);  // 垂直扩展填充

// 顶部信息区 (占据第1列，第0行，水平跨2列)
$grid->append($infoLabel, 1, 0, 1, 1, true, 1, false, 2);  // 水平扩展，左对齐，垂直居中
$grid->append($logoutBtn, 2, 0, 1, 1, false, 2, false, 2); // 不扩展，居中对齐

// 主内容区 (占据第1列，第1行，水平跨2列)
$grid->append($contentLabel, 1, 1, 2, 1, true, 0, true, 0);  // 水平和垂直都扩展填充

// 状态栏 (占据第0-2列，第2行)
$grid->append($statusLabel, 0, 2, 3, 1, true, 1, false, 2);  // 水平扩展，左对齐，垂直居中

$win->setChild($grid);

// 窗口关闭事件
$win->onClose(function ($window) {
    UI::exit();
    return true;
});

$win->show();
UI::run();