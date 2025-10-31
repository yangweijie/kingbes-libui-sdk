# IFLOW.md - 项目上下文说明

## 1. 项目概述

这是一个 PHP 项目，旨在为 [libui](https://github.com/andlabs/libui) GUI 库提供一个面向对象的 PHP 封装。它允许开发者使用更符合 PHP 习惯的 API 来创建跨平台的桌面图形用户界面应用程序。

- **项目名称**: yangweijie/ui
- **项目类型**: PHP 库 (Library)
- **主要技术**:
  - PHP 8.2+
  - PHP FFI (Foreign Function Interface) 扩展
  - [kingbes/libui](https://github.com/kingbes/php-libui) (核心 FFI 绑定库)
- **目标平台**:
  - Windows Vista SP2 x86_64 或更高版本
  - macOS OS X 10.8 x86_64 或更高版本
  - Linux GTK+ 3.10 x86_64 或更高版本

## 2. 项目结构

```
D:\git\php\ui\
├── composer.json          # 项目依赖和自动加载配置
├── composer.lock          # 依赖版本锁定文件
├── IFLOW.md               # 项目上下文说明文件
├── README.md              # 项目说明文档
├── src\                   # 项目源码目录
│   ├── Area.php           # Area 相关类
│   ├── Control.php        # 控件基类
│   ├── Executor.php       # 执行器类
│   ├── Key.php            # 键盘事件相关类
│   ├── Menu.php           # 菜单类
│   ├── MenuItem.php       # 菜单项类
│   ├── Point.php          # 点坐标类
│   ├── Size.php           # 尺寸类
│   ├── UI.php             # UI 入口类
│   ├── Window.php         # 窗口类
│   ├── Area\              # Area 子目录
│   │   └── DrawParams.php # Area 绘图参数类
│   ├── Controls\          # 控件类目录
│   │   ├── Box.php        # 布局容器控件
│   │   ├── Button.php     # 按钮控件
│   │   ├── Checkbox.php   # 复选框控件
│   │   ├── Combobox.php   # 下拉框控件
│   │   ├── DateTimePicker.php # 日期时间选择器控件
│   │   ├── EditableCombobox.php # 可编辑下拉框控件
│   │   ├── Entry.php      # 单行输入框控件
│   │   ├── Form.php       # 表单布局控件
│   │   ├── Grid.php       # 网格布局控件
│   │   ├── Group.php      # 分组控件
│   │   ├── Label.php      # 标签控件
│   │   ├── MultilineEntry.php # 多行输入框控件
│   │   ├── ProgressBar.php # 进度条控件
│   │   ├── Radio.php      # 单选框控件
│   │   ├── Separator.php  # 分隔符控件
│   │   ├── Slider.php     # 滑块控件
│   │   ├── Spinbox.php    # 数值输入框控件
│   │   └── Tab.php        # 标签页控件
│   ├── Draw\              # 绘图相关类目录
│   │   ├── Brush.php      # 画笔基类
│   │   ├── Color.php      # 颜色类
│   │   ├── Matrix.php     # 矩阵变换类
│   │   ├── Path.php       # 路径类
│   │   ├── Pen.php        # 画笔类
│   │   ├── Stroke.php     # 描边类
│   │   ├── Brush\         # 画笔子目录
│   │   │   ├── Gradient.php        # 渐变画笔基类
│   │   │   ├── LinearGradient.php  # 线性渐变画笔
│   │   │   └── RadialGradient.php  # 径向渐变画笔
│   │   ├── Line\          # 线条相关类目录
│   │   │   ├── Cap.php    # 线条端点样式类
│   │   │   └── Join.php   # 线条连接点样式类
│   │   └── Text\          # 文本相关类目录
│   │       ├── Align.php  # 文本对齐方式类
│   │       ├── Font.php   # 字体类
│   │       ├── Layout.php # 文本布局类
│   │       └── Font\      # 字体子目录
│   │           ├── Descriptor.php # 字体描述符类
│   │           ├── Italic.php     # 字体斜体样式类
│   │           ├── Stretch.php    # 字体拉伸样式类
│   │           └── Weight.php     # 字体粗细样式类
│   └── Exception\         # 异常类目录
│       ├── InvalidArgumentException.php # 无效参数异常类
│       └── RuntimeException.php         # 运行时异常类
├── example\               # 示例代码目录
│   ├── button.php         # 按钮示例
│   ├── calculator.php     # 计算器示例
│   ├── complex.php        # 复杂示例
│   ├── grid.php           # 网格布局示例
│   ├── grid1.php          # 网格布局示例1
│   ├── grid2.php          # 网格布局示例2
│   ├── grid3.php          # 网格布局示例3
│   └── grid4.php          # 网格布局示例4
├── tests\                 # 测试代码目录
└── vendor\                # Composer 依赖库目录
    └── kingbes\libui\     # 核心 GUI 绑定库
        ├── README.md      # 核心库说明文档
        ├── composer.json  # 核心库配置
        ├── src\           # 核心库 PHP 绑定代码 (App, Window, Button 等)
        ├── lib\           # 预编译的 libui C 库文件 (Windows, Linux, macOS)
        └── test\          # 核心库示例和测试代码
```

## 3. 核心架构与组件

该库通过 PHP FFI 调用 [kingbes/libui](https://github.com/kingbes/php-libui) 提供的底层绑定来创建 GUI 元素，并在此基础上提供面向对象的封装。

### 3.1. 核心入口点

- `UI\UI::init()`: 初始化 UI 库
- `UI\UI::run()`: 启动主事件循环
- `UI\UI::exit()`: 退出应用

### 3.2. 核心组件

- `UI\Window`: 创建和管理窗口
- `UI\Control`: 所有 UI 控件的基类
- `UI\Controls\Box`: 布局容器 (水平/垂直)
- `UI\Controls\Button`: 按钮控件
- `UI\Controls\Label`: 标签控件
- `UI\Controls\Entry`: 输入框控件
- `UI\Controls\Checkbox`: 复选框控件
- `UI\Controls\Combobox`: 下拉框控件
- `UI\Controls\EditableCombobox`: 可编辑下拉框控件
- `UI\Controls\DateTimePicker`: 日期时间选择器控件
- `UI\Controls\Form`: 表单布局控件
- `UI\Controls\Grid`: 网格布局控件
- `UI\Controls\Group`: 分组控件
- `UI\Controls\MultilineEntry`: 多行输入框控件
- `UI\Controls\ProgressBar`: 进度条控件
- `UI\Controls\Radio`: 单选框控件
- `UI\Controls\Separator`: 分隔符控件
- `UI\Controls\Slider`: 滑块控件
- `UI\Controls\Spinbox`: 数值输入框控件
- `UI\Controls\Tab`: 标签页控件
- `UI\Size`: 用于表示尺寸
- `UI\Point`: 用于表示坐标点
- `UI\Draw\Brush`: 画笔基类
- `UI\Draw\Brush\Gradient`: 渐变画笔基类
- `UI\Draw\Brush\LinearGradient`: 线性渐变画笔
- `UI\Draw\Brush\RadialGradient`: 径向渐变画笔
- `UI\Draw\Color`: 颜色类
- `UI\Draw\Font`: 字体类
- `UI\Draw\Text\Layout`: 文本布局类

### 3.3. 工作原理

1. PHP 代码通过 `UI\` 命名空间的类与 GUI 元素交互
2. 这些类内部调用 [kingbes/libui](https://github.com/kingbes/php-libui) 提供的 FFI 绑定
3. FFI 绑定负责与原生 `libui` C 库交互
4. 原生 `libui` C 库负责与操作系统的 GUI 系统交互

## 4. 构建、运行与开发

### 4.1. 环境要求

- PHP 8.2 或更高版本
- 启用 `FFI` 扩展
- 支持的 64 位操作系统 (Windows, macOS, Linux)

### 4.2. 安装依赖

```bash
# 安装项目依赖 (包括 kingbes/libui)
composer install
```

### 4.3. 运行示例

项目提供了多个示例代码：

```bash
# 运行一个简单的按钮示例
php example/button.php
```

### 4.4. 运行测试

本项目使用 Pest 和 PHPUnit 作为测试框架：

```bash
# 使用 Pest 运行测试
php run_pest_tests.php

# 使用 PHPUnit 运行测试
php run_phpunit_tests.php
```

### 4.5. 开发

- **自动加载**: 项目遵循 PSR-4 标准，`UI\` 命名空间映射到 `src/` 目录
- **代码风格**: 采用 PHPDoc 注释规范，类和方法有明确的文档说明
- **API 设计**: API 设计尽可能贴近 PHP 官方 UI 扩展的接口，方便开发者学习和使用