<?php
require dirname(__DIR__) . '/vendor/autoload.php';

use UI\UI;
use UI\Controls\Table;
use Kingbes\Libui\TableValueType;

// 添加错误报告
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "开始测试 Table 控件...\n";

try {
    // 初始化UI库
    UI::init();
    echo "UI库初始化完成\n";
    
    // 创建简单的表格模型处理器
    $cellValueCallback = function($handler, $row, $column) {
        return \Kingbes\Libui\Table::createValueStr("Row $row, Col $column");
    };
    
    // 创建表格
    $table = new Table(
        3, // 3列
        TableValueType::String, // 字符串类型
        5, // 5行
        $cellValueCallback
    );
    echo "Table 控件创建成功\n";
    
    // 添加列
    $table->appendTextColumn('Column 1', 0, false);
    $table->appendTextColumn('Column 2', 1, false);
    $table->appendTextColumn('Column 3', 2, false);
    echo "表格列添加成功\n";
    
    echo "Table 控件测试完成\n";
} catch (Exception $e) {
    echo "异常: " . $e->getMessage() . "\n";
    echo "文件: " . $e->getFile() . "\n";
    echo "行号: " . $e->getLine() . "\n";
} catch (Error $e) {
    echo "错误: " . $e->getMessage() . "\n";
    echo "文件: " . $e->getFile() . "\n";
    echo "行号: " . $e->getLine() . "\n";
}
