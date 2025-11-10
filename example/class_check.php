<?php
require_once __DIR__ . "/../vendor/autoload.php";

// 检查 Kingbes\Libui\App 类是否存在
if (class_exists('Kingbes\\Libui\\App')) {
    echo "Kingbes\\Libui\\App 类存在\n";
} else {
    echo "Kingbes\\Libui\\App 类不存在\n";
}

// 检查 Kingbes\Libui\Window 类是否存在
if (class_exists('Kingbes\\Libui\\Window')) {
    echo "Kingbes\\Libui\\Window 类存在\n";
} else {
    echo "Kingbes\\Libui\\Window 类不存在\n";
}

// 检查 Kingbes\Libui\Control 类是否存在
if (class_exists('Kingbes\\Libui\\Control')) {
    echo "Kingbes\\Libui\\Control 类存在\n";
} else {
    echo "Kingbes\\Libui\\Control 类不存在\n";
}