<?php
require_once __DIR__ . "/../vendor/autoload.php";

use Kingbes\Libui\App;
use Kingbes\Libui\Window;
use Kingbes\Libui\Control;
use Kingbes\Libui\Label;

try {
    // 初始化应用
    App::init();
    echo "应用初始化成功\n";
    
    // 创建窗口
    $window = Window::create("测试窗口", 300, 200, 1);
    echo "窗口创建成功\n";
    
    // 设置窗口边距
    Window::setMargined($window, true);
    
    // 创建标签
    $label = Label::create("Hello, Kingbes Libui!");
    echo "标签创建成功\n";
    
    // 设置窗口内容
    Window::setChild($window, $label);
    
    // 显示窗口
    Control::show($window);
    echo "窗口显示成功\n";
    
    // 运行应用
    echo "开始运行应用...\n";
    App::main();
} catch (Exception $e) {
    echo "错误: " . $e->getMessage() . "\n";
    echo "堆栈跟踪: " . $e->getTraceAsString() . "\n";
}
