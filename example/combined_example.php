<?php

require dirname(__DIR__) . "/vendor/autoload.php";

use UI\UI;
use UI\Window;
use UI\Size;
use UI\Controls\Tab;
use UI\Controls\Box;
use UI\Controls\Orientation;
use UI\Controls\Label;
use UI\Controls\Button;
use UI\Controls\Combobox;
use UI\Controls\Spinbox;
use UI\Controls\ProgressBar;
use UI\Controls\EditableCombobox;
use UI\Controls\MultilineEntry;
use UI\Controls\Radio;
use UI\Controls\DateTimePicker;
use UI\Controls\Group;
use UI\Controls\Separator;

// 初始化UI库
UI::init();

// 创建主窗口
$window = new Window("组合示例 - 所有组件展示", new Size(700, 600), true);

// === 扩展组件示例 (标签页1) ===
$extendedBox = new Box(Orientation::Vertical);
$extendedBox->setPadded(true);

// 创建下拉列表框示例
$comboLabel = new Label("下拉列表框示例：");
$extendedBox->append($comboLabel, false);

$comboBox = new Combobox();
$comboBox->append("北京");
$comboBox->append("上海");
$comboBox->append("广州");
$comboBox->append("深圳");
$comboBox->append("杭州");
$comboBox->append("南京");
$comboBox->append("成都");
$comboBox->setSelected(0);

// 为下拉列表框设置事件处理
$comboBox->onSelected(function ($combo) use ($window) {
    $selectedIndex = $combo->getSelected();
    // 这里需要获取选中的文本，但UI库的Combobox没有提供直接的方法
    // 我们可以通过其他方式实现
    $window->msgBox("提示", "选中了索引: " . $selectedIndex);
});

$extendedBox->append($comboBox, false);

// 创建微调框示例
$spinLabel = new Label("微调框示例：");
$extendedBox->append($spinLabel, false);

$spinBox = new Spinbox(0, 120);
$spinBox->setValue(25);

// 为微调框设置事件处理
$spinBox->onChange(function ($spin) use ($window) {
    $value = $spin->getValue();
    echo "年龄改变为: " . $value . "\n";
});

$extendedBox->append($spinBox, false);

// 创建进度条示例
$progressLabel = new Label("进度条示例：");
$extendedBox->append($progressLabel, false);

$progressBar = new ProgressBar();

// 添加控制按钮
$buttonBox = new Box(Orientation::Horizontal);
$buttonBox->setPadded(true);

$startButton = new Button("开始");
$resetButton = new Button("重置");

$buttonBox->append($startButton, true);
$buttonBox->append($resetButton, true);

// 进度条控制逻辑
$currentProgress = 0;

$startButton->onClick(function () use (&$currentProgress, $progressBar) {
    // 模拟进度更新
    if ($currentProgress < 100) {
        $currentProgress += 10;
        $progressBar->setValue($currentProgress);
    }
});

$resetButton->onClick(function () use (&$currentProgress, $progressBar) {
    $currentProgress = 0;
    $progressBar->setValue(0);
});

$extendedBox->append($progressBar, false);
$extendedBox->append($buttonBox, false);

// === 更多组件示例 (标签页2) ===
$moreBox = new Box(Orientation::Vertical);
$moreBox->setPadded(true);

// 创建日期时间选择器示例
$dateTimeLabel = new Label("日期时间选择器示例：");
$moreBox->append($dateTimeLabel, false);

// 创建日期时间选择器
$dateTimePicker = new DateTimePicker(0); // 0 = DateTime

// 创建日期选择器
$datePicker = new DateTimePicker(1); // 1 = Date

// 创建时间选择器
$timePicker = new DateTimePicker(2); // 2 = Time

// 日期时间选择器事件
$dateTimePicker->onChanged(function ($picker) use ($window) {
    echo "时间日期时间选择器事件\n";
    // 获取时间并显示
    try {
        $time = $picker->getTime();
        $timeStr = sprintf("%04d-%02d-%02d %02d:%02d:%02d", 
            $time->year, $time->mon, $time->mday,
            $time->hour, $time->min, $time->sec);
        echo "选择了日期时间: " . $timeStr . "\n";
    } catch (Exception $e) {
        echo "获取日期时间时出错: " . $e->getMessage() . "\n";
    }
});

$moreBox->append($dateTimePicker, false);

// 日期选择器事件
$datePicker->onChanged(function ($picker) {
    echo "日期选择器事件\n";
    // 获取时间并显示
    try {
        $time = $picker->getTime();
        $timeStr = sprintf("%04d-%02d-%02d", 
            $time->year, $time->mon, $time->mday);
        echo "选择了日期: " . $timeStr . "\n";
    } catch (Exception $e) {
        echo "获取日期时出错: " . $e->getMessage() . "\n";
    }
});

$moreBox->append($datePicker, false);

// 时间选择器事件
$timePicker->onChanged(function ($picker) {
    echo "时间选择器事件\n";
    // 获取时间并显示
    try {
        $time = $picker->getTime();
        $timeStr = sprintf("%02d:%02d:%02d", 
            $time->hour, $time->min, $time->sec);
        echo "选择了时间: " . $timeStr . "\n";
    } catch (Exception $e) {
        echo "获取时间时出错: " . $e->getMessage() . "\n";
    }
});

$moreBox->append($timePicker, false);

// 创建可编辑下拉列表框示例
$editableComboLabel = new Label("可编辑下拉列表框示例：");
$moreBox->append($editableComboLabel, false);

$editableComboBox = new EditableCombobox();
$editableComboBox->append("北京");
$editableComboBox->append("上海");
$editableComboBox->append("广州");
$editableComboBox->append("深圳");
$editableComboBox->append("杭州");
$editableComboBox->setText("请输入或选择城市");

$editableComboBox->onChange(function ($combo) use ($window) {
    $text = $combo->getText();
    echo "可编辑下拉框文本改变为: " . $text . "\n";
});

$moreBox->append($editableComboBox, false);

// 创建多行文本输入框示例
$multilineLabel = new Label("多行文本输入框示例：");
$moreBox->append($multilineLabel, false);

$multilineEntry = new MultilineEntry();
$multilineEntry->setText("请输入描述信息...\n支持多行输入");

$multilineEntry->onChanged(function ($entry) use ($window) {
    echo "多行文本改变\n";
});

$moreBox->append($multilineEntry, false);

// 创建单选按钮组示例
$radioLabel = new Label("单选按钮组示例：");
$moreBox->append($radioLabel, false);

$radioGroup = new Radio();
$radioGroup->append("男");
$radioGroup->append("女");
$radioGroup->append("其他");
$radioGroup->setSelected(0);

$radioGroup->onSelected(function ($radio) use ($window) {
    $selectedIndex = $radio->getSelected();
    // 这里需要获取选中的文本，但UI库的Radio没有提供直接的方法
    // 我们可以通过其他方式实现
    $window->msgBox("提示", "选择了索引: " . $selectedIndex);
});

$moreBox->append($radioGroup, false);

// 添加控制按钮
$moreButtonBox = new Box(Orientation::Horizontal);
$moreButtonBox->setPadded(true);

$showButton = new Button("显示信息");
$resetMoreButton = new Button("重置");

$moreButtonBox->append($showButton, true);
$moreButtonBox->append($resetMoreButton, true);

$showButton->onClick(function () use ($editableComboBox, $multilineEntry, $radioGroup, $window, $dateTimePicker) {
    $editableText = $editableComboBox->getText();
    $multilineText = $multilineEntry->getText();
    $radioIndex = $radioGroup->getSelected();
    
    // 获取日期时间信息
    $timeStr = "";
    try {
        $time = $dateTimePicker->getTime();
        $timeStr = sprintf("%04d-%02d-%02d %02d:%02d:%02d", 
            $time->year, $time->mon, $time->mday,
            $time->hour, $time->min, $time->sec);
    } catch (Exception $e) {
        $timeStr = "获取日期时间时出错: " . $e->getMessage();
    }
    
    $info = "城市: " . $editableText . "\n" .
            "描述: " . $multilineText . "\n" .
            "性别索引: " . $radioIndex . "\n" .
            "日期时间: " . $timeStr;
    
    $window->msgBox("信息", $info);
});

$resetMoreButton->onClick(function () use ($editableComboBox, $multilineEntry, $radioGroup) {
    $editableComboBox->setText("请输入或选择城市");
    $multilineEntry->setText("请输入描述信息...\n支持多行输入");
    $radioGroup->setSelected(0);
});

$moreBox->append($moreButtonBox, false);

// === 新组件示例 (标签页3) ===
$newComponentsBox = new Box(Orientation::Vertical);
$newComponentsBox->setPadded(true);

// 创建组面板示例
$groupLabel = new Label("组面板示例：");
$newComponentsBox->append($groupLabel, false);

// 创建一个组
$group = new Group("用户信息");
$group->setMargin(true);

// 在组内创建一个垂直盒子布局
$groupBox = new Box(Orientation::Vertical);
$groupBox->setPadded(true);

// 添加一些控件到组内
$nameLabel = new Label("姓名: 张三");
$ageLabel = new Label("年龄: 25岁");
$emailLabel = new Label("邮箱: zhangsan@example.com");

$groupBox->append($nameLabel, false);
$groupBox->append($ageLabel, false);
$groupBox->append($emailLabel, false);

// 将盒子设置为组的子控件
$group->setChild($groupBox);

$newComponentsBox->append($group, false);

// 添加分隔符
$separator = Separator::createHorizontal();
$newComponentsBox->append($separator, false);

// 将示例添加到标签页中
$tabPanel = new Tab();

// 将示例添加到标签页中
$tabPanel->append("扩展组件示例", $extendedBox);
$tabPanel->append("更多组件示例", $moreBox);
$tabPanel->append("新组件示例", $newComponentsBox);

// 设置窗口内容
$window->setChild($tabPanel);

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