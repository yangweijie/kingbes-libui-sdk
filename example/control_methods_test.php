<?php
require dirname(__DIR__) . '/vendor/autoload.php';

use UI\UI;
use UI\Controls\Button;

// 添加错误报告
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "开始测试 Control 类的方法...\n";

try {
    // 初始化UI库
    UI::init();
    echo "UI库初始化完成\n";
    
    // 创建按钮控件
    $button = new Button('Test Button');
    echo "按钮控件创建成功\n";
    
    // 测试 isVisible 方法
    $visible = $button->isVisible();
    echo "按钮可见性: " . ($visible ? '可见' : '不可见') . "\n";
    
    // 测试 isEnabled 方法
    $enabled = $button->isEnabled();
    echo "按钮启用状态: " . ($enabled ? '启用' : '禁用') . "\n";
    
    // 测试 getTopLevel 方法
    $topLevel = $button->getTopLevel();
    echo "按钮等级: $topLevel\n";
    
    // 测试 disable 和 enable 方法
    $button->disable();
    $enabled = $button->isEnabled();
    echo "禁用后按钮启用状态: " . ($enabled ? '启用' : '禁用') . "\n";
    
    $button->enable();
    $enabled = $button->isEnabled();
    echo "启用后按钮启用状态: " . ($enabled ? '启用' : '禁用') . "\n";
    
    echo "Control 类方法测试完成\n";
} catch (Exception $e) {
    echo "异常: " . $e->getMessage() . "\n";
    echo "文件: " . $e->getFile() . "\n";
    echo "行号: " . $e->getLine() . "\n";
} catch (Error $e) {
    echo "错误: " . $e->getMessage() . "\n";
    echo "文件: " . $e->getFile() . "\n";
    echo "行号: " . $e->getLine() . "\n";
}
