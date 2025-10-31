<?php
require dirname(__DIR__) . "/vendor/autoload.php";

use UI\UI;
use UI\Window;
use UI\Size;
use UI\Controls\Box;
use UI\Controls\Orientation;
use UI\Controls\Label;
use UI\Controls\Spinbox;

// 初始化UI库
UI::init();

// 创建主窗口
$window = new Window("直方图示例", new Size(640, 480), true);
$window->setMargin(true);

// 创建主容器
$mainBox = new Box(Orientation::Horizontal);
$mainBox->setPadded(true);

// 创建左侧控制面板
$controlBox = new Box(Orientation::Vertical);
$controlBox->setPadded(true);

// 添加标题
$titleLabel = new Label("数据点控制:");
$controlBox->append($titleLabel, false);

// 添加数据点控制
for ($i = 0; $i < 10; $i++) {
    $label = new Label("数据点 " . ($i + 1) . ":");
    $controlBox->append($label, false);
    
    $spinbox = new Spinbox(0, 100);
    $spinbox->setValue(rand(0, 90));
    
    $controlBox->append($spinbox, false);
}

// 创建一个简单的标签作为右侧内容
$rightLabel = new Label("这里是绘图区域");

// 将控件添加到主容器
$mainBox->append($controlBox, false);
$mainBox->append($rightLabel, true);

// 设置窗口内容
$window->setChild($mainBox);

// 显示窗口
$window->show();

// 运行应用
UI::run();