<?php

require dirname(__DIR__) . "/vendor/autoload.php";

use UI\UI;
use UI\Window;
use UI\Size;
use UI\Controls\Button;
use UI\Controls\Entry;
use UI\Controls\EntryType;
use UI\Controls\MultilineEntry;
use UI\Controls\Separator;
use UI\Controls\DateTimePicker;
use UI\Controls\Grid;
use UI\Controls\Label;

// 初始化应用
UI::init();

// 创建窗口
$window = new Window("复杂示例", new Size(500, 400), false);
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

// 第一行：用户名
$userLabel = new Label('用户名:');
$userEntry = new Entry();
$grid->append($userLabel, 0, 0, 1, 1, false, 2, false, 2); // Center alignment
$grid->append($userEntry, 1, 0, 1, 1, true, 2, false, 2);

// 第二行：密码
$passLabel = new Label('密码:');
$passEntry = new Entry(EntryType::Password); // 创建密码输入框
$grid->append($passLabel, 0, 1, 1, 1, false, 0, false, 0); // Center alignment
$grid->append($passEntry, 1, 1, 1, 1, false, 0, false, 0); // Fill alignment


// 第四行：日期时间选择器


// 第六行：按钮
$loginBtn = new Button("登录");
$cancelBtn = new Button("取消");
$grid->append($loginBtn, 0, 6, 1, 1, false, 1, false, 1); // Start alignment
$grid->append($cancelBtn, 1, 6, 1, 1, false, 2, false, 1); // Center alignment

$statusLabel = new Label('请输入用户名和密码');
$grid->append($statusLabel, 0, 3, 2, 1); // 在底部添加一个状态标签

// 设置窗口内容
$window->setChild($grid);

// 设置按钮事件
$loginBtn->onClick(function ($button) use ($userEntry, $passEntry, $statusLabel) {
    $username = $userEntry->getText();
    $password = $passEntry->getText();
    echo "登录按钮点击\n";
    echo "用户名: " . $userEntry->getText() . "\n";
    echo "密码: " . $passEntry->getText() . "\n";
    if (empty($username) || empty($password)) {
        $statusLabel->setText('错误：用户名和密码不能为空！');
        return;
    }
    // 模拟登录验证
    if ($username === 'admin' && $password === '123456') {
        $statusLabel->setText('登录成功，欢迎 admin！');
    } else {
        $statusLabel->setText('登录失败，请检查后重试。');
    }
});

$cancelBtn->onClick(function ($button) use ($window) {
    echo "取消按钮点击\n";
    $window->msgBox("提示", "操作已取消");
});

// 显示窗口
$window->show();

// 启动主循环
UI::run();