<?php
require dirname(__DIR__) . "/vendor/autoload.php";

use UI\UI;
use UI\Window;
use UI\Size;
use UI\Controls\Image;

// 初始化UI库
UI::init();

// 创建窗口
$window = new Window("Image Example", new Size(640, 480));
// 窗口设置边框
$window->setMargin(true);

// 创建图片控件
$image = new Image(32, 32);

// 追加图片数据
$imagePath = __DIR__ . "/../vendor/kingbes/libui/libui.png";
if (file_exists($imagePath)) {
    $image->append($imagePath);
} else {
    // 如果 libui.png 不存在，尝试其他可能的路径
    $possiblePaths = [
        __DIR__ . "/../libui.png",
        __DIR__ . "/libui.png",
        __DIR__ . "/../vendor/kingbes/libui/test/libui.png"
    ];

    foreach ($possiblePaths as $path) {
        if (file_exists($path)) {
            $image->append($path);
            break;
        }
    }
}

// 设置窗口子元素
$window->setChild($image);

// 窗口关闭事件
$window->onClose(function ($window) {
    UI::exit();
    return true;
});

// 显示窗口
$window->show();

// 运行应用
UI::run();