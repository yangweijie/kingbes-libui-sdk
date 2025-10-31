<?php
require dirname(__DIR__) . "/vendor/autoload.php";

use UI\UI;

// 初始化UI库
UI::init();
echo "UI库初始化成功\n";

// 运行应用
UI::run();