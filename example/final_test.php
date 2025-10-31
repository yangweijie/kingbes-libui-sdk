<?php
require dirname(__DIR__) . "/vendor/autoload.php";

use UI\UI;
use UI\Window;
use UI\Size;
use UI\Controls\Label;

try {
    // 初始化UI库
    UI::init();
    echo "UI库初始化成功\n";
    
    // 创建主窗口
    $window = new Window("测试窗口", new Size(300, 200), true);
    $window->setMargined(true);
    echo "窗口创建成功\n";
    
    // 创建标签
    $label = new Label("Hello, UI Library!");
    echo "标签创建成功\n";
    
    // 设置窗口内容
    $window->setChild($label);
    echo "窗口内容设置成功\n";
    
    // 显示窗口
    $window->show();
    echo "窗口显示成功\n";
    
    // 运行应用
    echo "开始运行应用...\n";
    UI::run();
} catch (Exception $e) {
    echo "错误: " . $e->getMessage() . "\n";
    echo "堆栈跟踪: " . $e->getTraceAsString() . "\n";
}
