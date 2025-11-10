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

// 第二行：密码
$passLabel = new Label('密码:');
$passEntry = new Entry(EntryType::Password); // 创建密码输入框
$grid->append($passLabel, 0, 1, 1, 1, false, 2, false, 2); // Center alignment
$grid->append($passEntry, 1, 1, 1, 1, true, 0, false, 0); // Fill alignment

// 第三行：多行文本框
$multiLabel = new Label('描述:');
$multiEntry = new MultilineEntry();
$multiEntry->setText("请输入描述信息...");
$grid->append($multiLabel, 0, 2, 1, 1, false, 2, false, 2); // Center alignment
$grid->append($multiEntry, 1, 2, 1, 2, true, 0, true, 0); // Fill alignment

// 第四行：日期时间选择器
$dateLabel = new Label('日期时间:');
$dateTimePicker = new DateTimePicker(0); // DateTime
$grid->append($dateLabel, 0, 4, 1, 1, false, 2, false, 2); // Center alignment
$grid->append($dateTimePicker, 1, 4, 1, 1, true, 0, false, 0); // Fill alignment

// 第五行：分隔符
$separator = Separator::createHorizontal();
$grid->append($separator, 0, 5, 2, 1, true, 0, false, 0); // Fill alignment

// 第六行：按钮
$loginBtn = new Button("登录");
$cancelBtn = new Button("取消");
$grid->append($loginBtn, 0, 6, 1, 1, false, 1, false, 1); // Start alignment
$grid->append($cancelBtn, 1, 6, 1, 1, false, 2, false, 1); // Center alignment

// ... 接上面的登录表示例 ...
$captchaLabel = new Label('验证码:');
$captchaEntry = new Entry();

// 在登录按钮($loginButton)的上方(Top)插入验证码行
$grid->insertAt($captchaLabel, $loginBtn, Grid::Top, 1, 1, false, Grid::Center, false, Grid::Center);
$grid->insertAt($captchaEntry, $captchaLabel, Grid::Trailing, 1, 1, true, Grid::Fill, false, Grid::Fill);

// 设置窗口内容
$window->setChild($grid);

// 设置按钮事件
$loginBtn->onClick(function ($button) use ($userEntry, $passEntry) {
    echo "登录按钮点击\n";
    echo "用户名: " . $userEntry->getText() . "\n";
    echo "密码: " . $passEntry->getText() . "\n";
});

$cancelBtn->onClick(function ($button) use ($window) {
    echo "取消按钮点击\n";
    $window->msgBox("提示", "操作已取消");
});

// 显示窗口
$window->show();

// 启动主循环
UI::run();