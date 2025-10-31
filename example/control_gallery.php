<?php
require dirname(__DIR__) . "/vendor/autoload.php";

use UI\UI;
use UI\Window;
use UI\Size;
use UI\Controls\Tab;
use UI\Controls\Box;
use UI\Controls\Orientation;
use UI\Controls\Button;
use UI\Controls\Label;
use UI\Controls\Group;
use UI\Controls\Separator;
use UI\Controls\DateTimePicker;
use UI\Controls\Checkbox;
use UI\Controls\SpinBox;
use UI\Controls\Slider;
use UI\Controls\ProgressBar;
use UI\Controls\Combobox;
use UI\Controls\EditableCombobox;
use UI\Controls\Radio;
use UI\Controls\MultilineEntry;
use UI\Controls\ColorButton;
use UI\Controls\FontButton;
use UI\Draw\Color;

// 初始化UI库
UI::init();

// 创建主窗口
$window = new Window("Control Gallery", new Size(600, 500));

// 左侧控件区
$leftBox = new Box(Orientation::Vertical);
$leftBox->setPadded(true);
$leftBox->append(new Button("Button"), false);
$leftBox->append(new Checkbox("Checkbox"), false);
$leftBox->append(new Label("Label"), false);
$leftBox->append(new DateTimePicker(1), false); // Date picker
$leftBox->append(new DateTimePicker(2), false); // Time picker
$leftBox->append(new DateTimePicker(0), false); // DateTime picker
$leftBox->append(new FontButton(), false); // 字体选择按钮
$leftBox->append(new ColorButton(), false); // 颜色选择按钮

$leftBox->append(Separator::createHorizontal(), false);

$leftGroup = new Group("Basic Controls");
$leftGroup->setChild($leftBox);
$leftGroup->setMargin(true);

// 数字控件区域
$numbersBox = new Box(Orientation::Vertical);
$numbersBox->setPadded(true);
$spinBox = new Spinbox(0, 100);
$spinBox->setValue(42);
$numbersBox->append($spinBox, false);
$slider1 = new Slider(0, 100);
$slider1->setValue(42);
$numbersBox->append($slider1, true);
$progressBar = new ProgressBar();
$progressBar->setValue(42);
$numbersBox->append($progressBar, true);
$numbersGroup = new Group("Numbers");
$numbersGroup->setChild($numbersBox);
$numbersGroup->setMargin(true);

// 列表控件区域
$listsBox = new Box(Orientation::Vertical);
$listsBox->setPadded(true);
$comboBox = new Combobox();
$comboBox->append("Combobox Item 1");
$comboBox->append("Combobox Item 2");
$comboBox->append("Combobox Item 3");
$comboBox->setSelected(0);
$listsBox->append($comboBox, false);
$editableComboBox = new EditableCombobox();
$editableComboBox->append("Editable Item 1");
$editableComboBox->append("Editable Item 2");
$editableComboBox->append("Editable Item 3");
$editableComboBox->setText("");
$listsBox->append($editableComboBox, false);
$radioGroup = new Radio();
$radioGroup->append("Radio Button 1");
$radioGroup->append("Radio Button 2");
$radioGroup->append("Radio Button 3");
$radioGroup->setSelected(0);
$listsBox->append($radioGroup, false);
$listsGroup = new Group("Lists");
$listsGroup->setChild($listsBox);
$listsGroup->setMargin(true);

// Tab 区域
$tabPanel = new Tab();
$tabPage1 = new Box(Orientation::Vertical);
$tabPage1->setPadded(true);
$multilineEntry = new MultilineEntry();
$multilineEntry->setText("Please enter your feelings");
$tabPage1->append($multilineEntry, true);
$tabPanel->append("Page 1", $tabPage1);
$tabPanel->append("Page 2", new Box(Orientation::Vertical));
$tabPanel->append("Page 3", new Box(Orientation::Vertical));

$rightBox = new Box(Orientation::Vertical);
$rightBox->setPadded(true);
$rightBox->append($numbersGroup, false);
$rightBox->append($listsGroup, false);
$rightBox->append($tabPanel, false);

$mainBox = new Box(Orientation::Horizontal);
$mainBox->setPadded(true);
$mainBox->append($leftGroup, true);
$mainBox->append($rightBox, true);

$window->setChild($mainBox);
$window->onClose(function ($window) {
    UI::exit();
    return true;
});
$window->show();
UI::run();