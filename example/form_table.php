<?php
require dirname(__DIR__) . '/vendor/autoload.php';

use UI\UI;
use UI\Window;
use UI\Size;
use UI\Controls\Box;
use UI\Controls\Orientation;
use UI\Controls\Label;
use UI\Controls\Entry;
use UI\Controls\EntryType;
use UI\Controls\Button;
use UI\Controls\Separator;
use UI\Controls\Table;
use Kingbes\Libui\TableValueType;
use Kingbes\Libui\TableSelectionMode;

// 初始化UI库
UI::init();

// 创建主窗口
$window = new Window('Contacts', new Size(600, 600));
$window->setMargin(true);

// 初始化联系人数据
$contactsOrigin = [
    ['Lisa Sky', 'lisa@sky.com', '720-523-4329', 'Denver', 'CO'],
    ['Jordan Biggins', 'jordan@biggins.', '617-528-5399', 'Boston', 'MA'],
    ['Mary Glass', 'mary@glass.con', '847-589-8788', 'Elk Grove Village', 'IL'],
    ['Darren McGrath', 'darren@mcgrat', '206-539-9283', 'Seattle', 'WA'],
    ['Melody Hanheir', 'melody@hanhei', '213-493-8274', 'Los Angeles', 'CA'],
];
$contacts = $contactsOrigin;
$filteredContacts = $contactsOrigin;

// 创建表单盒子
$fields = ['Name', 'Email', 'Phone', 'City', 'State'];
$entries = [];
$formBox = new Box(Orientation::Vertical);
$formBox->setPadded(true);

// 创建表单输入字段
foreach ($fields as $field) {
    $label = new Label($field);
    $entry = new Entry();
    $formBox->append($label, false);
    $formBox->append($entry, false);
    $entries[$field] = $entry;
}

// 创建保存按钮
$saveBtn = new Button('Save Contact');
$formBox->append($saveBtn, false);
$formBox->append(new Separator(), false);

// 创建搜索框
$searchEntry = new Entry(EntryType::Search);
$searchEntry->setText('');
$searchBtn = new Button('Search');
$searchBox = new Box(Orientation::Horizontal);
$searchBox->setPadded(true);
$searchBox->append($searchEntry, true); // 输入框可伸缩
$searchBox->append($searchBtn, false);
$formBox->append($searchBox, false);
$formBox->append(new Separator(), false);

// 创建表格模型处理器
$getTableModelHandler = function() use (&$filteredContacts) {
    return function($handler, $row, $column) use (&$filteredContacts) {
        if (isset($filteredContacts[$row][$column])) {
            return \Kingbes\Libui\Table::createValueStr($filteredContacts[$row][$column]);
        }
        return \Kingbes\Libui\Table::createValueStr('');
    };
};

// 创建表格
$table = new Table(
    5, // 列数
    TableValueType::String, // 列类型
    count($filteredContacts), // 行数
    $getTableModelHandler() // 单元格值回调
);

// 添加表格列
$table->appendTextColumn('Name', 0, false);
$table->appendTextColumn('Email', 1, false);
$table->appendTextColumn('Phone', 2, false);
$table->appendTextColumn('City', 3, false);
$table->appendTextColumn('State', 4, false);

// 将表格添加到表单盒子
$formBox->append($table, true);

// 保存联系人事件
$saveBtn->onClick(function ($button) use (&$contacts, &$filteredContacts, $entries, $window, $table) {
    $row = [];
    $allFilled = true;
    foreach (['Name', 'Email', 'Phone', 'City', 'State'] as $field) {
        $val = $entries[$field]->getText();
        if (trim($val) === '') {
            $allFilled = false;
        }
        $row[] = $val;
    }
    if ($allFilled) {
        foreach ($entries as $entry) {
            $entry->setText('');
        }
        global $contactsOrigin;
        $contactsOrigin[] = $row;
        $contacts = $contactsOrigin;
        $filteredContacts = $contactsOrigin;
        $table->modelRowInserted(count($filteredContacts)-1);
    }
});

// 搜索过滤事件
$searchBtn->onClick(function ($button) use (&$contacts, &$filteredContacts, $searchEntry, $table) {
    global $contactsOrigin;
    $keyword = trim($searchEntry->getText());
    $filteredContacts = [];
    if ($keyword === '') {
        $filteredContacts = $contactsOrigin;
    } else {
        foreach ($contactsOrigin as $row) {
            $found = false;
            foreach ($row as $cell) {
                if (strpos($cell, $keyword) !== false) {
                    $found = true;
                    break;
                }
            }
            if ($found) {
                $filteredContacts[] = $row;
            }
        }
    }
    // 清空并重建表格内容
    for ($i=0; $i < count($contacts); $i++) {
        $table->modelRowDeleted(count($contacts) -($i+1));
    }
    $contacts = $filteredContacts;
    foreach ($filteredContacts as $i => $row) {
        $table->modelRowInserted($i);
    }
});

// 设置窗口内容和关闭事件
$window->setChild($formBox);
$window->onClose(function ($window) {
    UI::exit();
    return true;
});

// 显示窗口并运行应用
$window->show();
UI::run();