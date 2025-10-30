<?php
require dirname(__DIR__) . "/vendor/autoload.php";

use UI\Controls\Button;
use UI\Controls\Entry;
use UI\Controls\EntryType;
use UI\Controls\Grid;
use UI\Controls\Label;
use UI\Size;
use UI\UI;
use UI\Window;

UI::init();

// 创建窗口
$win = new Window('仪表盘布局', new Size(600, 400), false);
$grid = new Grid();
$grid->setPadded(true);

// 1. 定义布局配置数组
$layoutConfig = [
    ['type' => Label::class,  'text' => '用户名:',   'left' => 0, 'top' => 0, 'halign' => Grid::End],
    ['type' => Entry::class,  'name' => 'username', 'left' => 1, 'top' => 0, 'hexpand' => true],
    ['type' => Label::class,  'text' => '密  码:',   'left' => 0, 'top' => 1, 'halign' => Grid::End],
    ['type' => Entry::class,  'name' => 'password', 'left' => 1, 'top' => 1, 'hexpand' => true, 'password' => true],
    ['type' => Button::class, 'text' => '登录',      'left' => 1, 'top' => 2, 'halign' => Grid::Center],
];

// ... 创建 $grid ...

$controls = []; // 用于存储创建的控件，方便后续访问

// 2. 循环配置数组，动态生成并添加控件
foreach ($layoutConfig as $config) {
    $controlType = $config['type'];
    if($controlType == Entry::class) {
        $initParams = !empty($config['password'])? EntryType::Password: EntryType::Normal;
    }else{
        $initParams = $config['text'] ?? '';
    }
    $control = new $controlType($initParams);
    if (!empty($config['name'])) {
        $controls[$config['name']] = $control;
    }

    $grid->append(
        $control,
        $config['left'],
        $config['top'],
        $config['xspan']   ?? 1,
        $config['yspan']   ?? 1,
        $config['hexpand'] ?? false,
        $config['halign']  ?? Grid::Fill,
        $config['vexpand'] ?? false,
        $config['valign']  ?? Grid::Fill
    );
}

// ... 将 grid 添加到窗口并运行 ...

$win->setChild($grid);

// 窗口关闭事件
$win->onClose(function ($window) {
    UI::exit();
    return true;
});

$win->show();
UI::run();