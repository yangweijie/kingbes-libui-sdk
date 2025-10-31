<?php
// 启用错误报告
error_reporting(E_ALL);
ini_set('display_errors', 1);

require dirname(__DIR__) . "/vendor/autoload.php";

use UI\UI;
use UI\Window;
use UI\Size;
use UI\Controls\Box;
use UI\Controls\Orientation;
use UI\Controls\Label;

try {
    // 初始化UI库
    echo "开始初始化UI库...\n";
    UI::init();
    echo "UI库初始化成功\n";
    
    // 创建主窗口
    echo "开始创建窗口...\n";
    $window = new Window("测试窗口", new Size(640, 480), true);
    $window->setMargin(true);
    echo "窗口创建成功\n";
    
    // 创建主容器
    echo "开始创建主容器...\n";
    $mainBox = new Box(Orientation::Horizontal);  // 修正常量引用
    $mainBox->setPadded(true);
    echo "主容器创建成功\n";
    
    // 创建标签
    echo "开始创建标签...\n";
    $label = new Label("Hello, UI Library!");
    echo "标签创建成功\n";
    
    // 将控件添加到主容器
    echo "开始添加控件到主容器...\n";
    $mainBox->append($label, false);
    echo "控件添加成功\n";
    
    // 设置窗口内容
    echo "开始设置窗口内容...\n";
    $window->setChild($mainBox);
    echo "窗口内容设置成功\n";
    
    // 显示窗口
    echo "开始显示窗口...\n";
    $window->show();
    echo "窗口显示成功\n";
    
    // 运行应用
    echo "开始运行应用...\n";
    UI::run();
} catch (Exception $e) {
    echo "捕获到异常: " . $e->getMessage() . "\n";
    echo "异常类型: " . get_class($e) . "\n";
    echo "堆栈跟踪: " . $e->getTraceAsString() . "\n";
} catch (Error $e) {
    echo "捕获到错误: " . $e->getMessage() . "\n";
    echo "错误类型: " . get_class($e) . "\n";
    echo "堆栈跟踪: " . $e->getTraceAsString() . "\n";
}