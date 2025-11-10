<?php

require dirname(__DIR__) . "/vendor/autoload.php";

use UI\UI;
use UI\Window;
use UI\Size;
use UI\Controls\Box;
use UI\Controls\Orientation;
use UI\Controls\Button;
use UI\Controls\Label;
use UI\Controls\Entry;
use UI\Controls\EntryType;
use UI\Controls\Checkbox;
use UI\Controls\Slider;
use UI\Controls\Tab;

// 初始化应用
UI::init();

// 创建主窗口
$window = new Window("UI 库组件示例", new Size(600, 400), false);
$window->setMargin(true);

// 创建主容器
$mainBox = new Box(Orientation::Vertical);
$mainBox->setPadded(true);

// 创建标签页面板
$tab = new Tab();

// 第一个标签页：按钮组示例
$buttonGroupBox = new Box(Orientation::Vertical);
$buttonGroupBox->setPadded(true);

$label1 = new Label("按钮组示例：");
$buttonGroupBox->append($label1, false);

// 创建按钮
$button1 = new Button("按钮1");
$button1->onClick(function ($btn) use ($window) {
    $window->msgBox("提示", "按钮1被点击了");
});

$button2 = new Button("按钮2");
$button2->onClick(function ($btn) use ($window) {
    $window->msgBox("提示", "按钮2被点击了");
});

$button3 = new Button("按钮3");
$button3->onClick(function ($btn) use ($window) {
    $window->msgBox("提示", "按钮3被点击了");
});

$buttonGroupBox->append($button1, false);
$buttonGroupBox->append($button2, false);
$buttonGroupBox->append($button3, false);

$tab->append("按钮组", $buttonGroupBox);

// 第二个标签页：表单示例
$formBox = new Box(Orientation::Vertical);
$formBox->setPadded(true);

$label2 = new Label("表单示例：");
$formBox->append($label2, false);

// 创建表单控件
$usernameEntry = new Entry(EntryType::Normal);
$usernameEntry->onChange(function ($entry) {
    echo "用户名改变: " . $entry->getText() . "\n";
});

$passwordEntry = new Entry(EntryType::Password);
$passwordEntry->onChange(function ($entry) {
    echo "密码改变\n";
});

$emailEntry = new Entry(EntryType::Normal);
$emailEntry->onChange(function ($entry) {
    echo "邮箱改变: " . $entry->getText() . "\n";
});

$formBox->append(new Label("用户名:"), false);
$formBox->append($usernameEntry, false);
$formBox->append(new Label("密码:"), false);
$formBox->append($passwordEntry, false);
$formBox->append(new Label("邮箱:"), false);
$formBox->append($emailEntry, false);

$tab->append("表单", $formBox);

// 第三个标签页：复选框组示例
$checkboxBox = new Box(Orientation::Vertical);
$checkboxBox->setPadded(true);

$label3 = new Label("复选框组示例：");
$checkboxBox->append($label3, false);

// 创建复选框
$checkbox1 = new Checkbox("选项1");
$checkbox1->setChecked(false);
$checkbox1->onToggle(function ($cb) use ($window) {
    $isChecked = $cb->isChecked();
    $window->msgBox("提示", "选项1 " . ($isChecked ? "选中" : "取消选中"));
});

$checkbox2 = new Checkbox("选项2");
$checkbox2->setChecked(true);
$checkbox2->onToggle(function ($cb) use ($window) {
    $isChecked = $cb->isChecked();
    $window->msgBox("提示", "选项2 " . ($isChecked ? "选中" : "取消选中"));
});

$checkbox3 = new Checkbox("选项3");
$checkbox3->setChecked(false);
$checkbox3->onToggle(function ($cb) use ($window) {
    $isChecked = $cb->isChecked();
    $window->msgBox("提示", "选项3 " . ($isChecked ? "选中" : "取消选中"));
});

$checkboxBox->append($checkbox1, false);
$checkboxBox->append($checkbox2, false);
$checkboxBox->append($checkbox3, false);

$tab->append("复选框", $checkboxBox);

// 第四个标签页：滑块示例
$sliderBox = new Box(Orientation::Vertical);
$sliderBox->setPadded(true);

$label4 = new Label("滑块示例：");
$sliderBox->append($label4, false);

// 创建滑块
$slider = new Slider(0, 100);
$slider->setValue(50);
$slider->onChange(function ($slider) {
    $value = $slider->getValue();
    echo "滑块值改变: $value\n";
});

$sliderBox->append($slider, false);

$tab->append("滑块", $sliderBox);

// 将标签页面板添加到主容器
$mainBox->append($tab, true);

// 设置窗口内容
$window->setChild($mainBox);

// 设置窗口关闭事件
$window->onClose(function ($window) {
    echo "窗口关闭\n";
    UI::exit();
    return true;
});

// 显示窗口
$window->show();

// 运行应用
UI::run();