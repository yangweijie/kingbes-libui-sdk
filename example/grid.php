<?php

require dirname(__DIR__) . "/vendor/autoload.php";

use UI\UI;
use UI\Window;
use UI\Size;
use UI\Controls\Grid;
use UI\Controls\Button;
use UI\Controls\Entry;
use UI\Controls\Label;

// 初始化应用
UI::init();

// 创建窗口
$window = new Window("Grid 示例", new Size(400, 300), false);
$window->setMargin(true);

// 窗口关闭事件
$window->onClose(function ($window) {
    echo "窗口关闭\n";
    UI::exit();
    return true;
});

// 创建网格布局
$grid = new Grid();
$grid->setPadded(true);

// 创建控件
$label1 = new Label("姓名:");
$entry1 = new Entry();
$label2 = new Label("邮箱:");
$entry2 = new Entry();
$button1 = new Button("提交");
$button2 = new Button("取消");

// 添加控件到网格
// 第一行
$grid->append($label1, 0, 0);  // 左侧标签
$grid->append($entry1, 1, 0, 2, 1, true, 0, false, 0);  // 右侧输入框，水平扩展

// 第二行
$grid->append($label2, 0, 1);  // 左侧标签
$grid->append($entry2, 1, 1, 2, 1, true, 0, false, 0);  // 右侧输入框，水平扩展

// 第三行
$grid->append($button1, 1, 2, 1, 1, false, 1, false, 1);  // 左侧按钮
$grid->append($button2, 2, 2, 1, 1, false, 2, false, 1);  // 右侧按钮

// 设置窗口内容
$window->setChild($grid);

// 显示窗口
$window->show();

// 启动主循环
UI::run();