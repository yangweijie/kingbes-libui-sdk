<?php
require dirname(__DIR__) . "/vendor/autoload.php";

use UI\UI;
use UI\Window;
use UI\Size;
use UI\Controls\Box;
use UI\Controls\Orientation;
use UI\Controls\DateTimePicker;

// 初始化UI库
UI::init();

// 创建主窗口
$window = new Window("DateTime Picker Example", new Size(400, 300));
$window->setMargin(true);

// 创建垂直布局盒子
$mainBox = new Box(Orientation::Vertical);
$mainBox->setPadded(true);

// 创建日期时间选择器
$dateTimePicker = new DateTimePicker(0); // 0 = DateTime
// 创建日期选择器
$datePicker = new DateTimePicker(1); // 1 = Date
// 创建时间选择器
$timePicker = new DateTimePicker(2); // 2 = Time

// 添加控件到布局中
$mainBox->append($dateTimePicker, false);
$mainBox->append($datePicker, false);
$mainBox->append($timePicker, false);

// 时间日期时间选择器事件（简化版本）
$dateTimePicker->onChanged(function ($picker)use($dateTimePicker) {
    echo "时间日期时间选择器事件";
    // 显示选中的事件
    var_dump($dateTimePicker->getTime());
    // 简单的事件处理，不显示消息框
});

// 日期选择器事件
$datePicker->onChanged(function ($picker)use($datePicker) {
    echo "日期选择器事件";
    var_dump($datePicker->getTime());
    // 简单的事件处理，不显示消息框
});

// 时间选择器事件
$timePicker->onChanged(function ($picker) use($timePicker){
    echo "时间选择器事件";
    var_dump($timePicker->getTime());
    // 简单的事件处理，不显示消息框
});

// 设置窗口内容
$window->setChild($mainBox);

// 设置窗口关闭事件
$window->onClose(function ($window) {
    UI::exit();
    return true;
});

// 显示窗口
$window->show();

// 运行应用
UI::run();