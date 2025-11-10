<?php

namespace UI;

use Kingbes\Libui\Window as LibuiWindow;
use Kingbes\Libui\Control as LibuiControl;
use FFI\CData;

/**
 * 窗口控件
 */
class Window
{
    /**
     * @var CData 窗口句柄
     */
    protected CData $window;

    /**
     * 构造一个新的窗口
     *
     * @param string $title 窗口标题
     * @param Size $size 窗口大小
     * @param bool $menu 是否有菜单栏
     */
    public function __construct(string $title, Size $size, bool $menu = false)
    {
        $this->window = LibuiWindow::create($title, $size->width, $size->height, $menu ? 1 : 0);
    }

    /**
     * 获取窗口标题
     *
     * @return string
     */
    public function getTitle(): string
    {
        return LibuiWindow::title($this->window);
    }

    /**
     * 设置窗口标题
     *
     * @param string $title
     * @return void
     */
    public function setTitle(string $title): void
    {
        LibuiWindow::setTitle($this->window, $title);
    }

    /**
     * 设置窗口内容区域的大小
     *
     * @param Size $size
     * @return void
     */
    public function setSize(Size $size): void
    {
        LibuiWindow::setContentSize($this->window, $size->width, $size->height);
    }

    /**
     * 获取窗口内容区域的大小
     *
     * @return Size
     */
    public function getSize(): Size
    {
        // 注意：libui 的 FFI 接口没有直接获取内容大小的函数，这里需要通过其他方式实现或模拟
        // 暂时返回一个默认值或抛出异常
        // 实际应用中可能需要更复杂的处理
        return new Size(0, 0);
    }

    /**
     * 设置窗口是否全屏
     *
     * @param bool $fullscreen
     * @return void
     */
    public function setFullscreen(bool $fullscreen): void
    {
        LibuiWindow::setFullscreen($this->window, $fullscreen);
    }

    /**
     * 检查窗口是否全屏
     *
     * @return bool
     */
    public function isFullscreen(): bool
    {
        return LibuiWindow::fullscreen($this->window);
    }

    /**
     * 设置窗口是否无边框
     *
     * @param bool $borderless
     * @return void
     */
    public function setBorderless(bool $borderless): void
    {
        LibuiWindow::setBorderless($this->window, $borderless);
    }

    /**
     * 检查窗口是否无边框
     *
     * @return bool
     */
    public function isBorderless(): bool
    {
        return LibuiWindow::borderless($this->window);
    }

    /**
     * 设置窗口子控件
     *
     * @param Control $child
     * @return void
     */
    public function setChild(Control $child): void
    {
        LibuiWindow::setChild($this->window, $child->getHandle());
    }

    /**
     * 设置窗口是否有边距
     *
     * @param bool $margin
     * @return void
     */
    public function setMargin(bool $margin): void
    {
        LibuiWindow::setMargined($this->window, $margin);
    }

    /**
     * 检查窗口是否有边距
     *
     * @return bool
     */
    public function hasMargin(): bool
    {
        return LibuiWindow::margined($this->window);
    }

    /**
     * 设置窗口是否可调整大小
     *
     * @param bool $resizable
     * @return void
     */
    public function setResizable(bool $resizable): void
    {
        LibuiWindow::setResizable($this->window, $resizable);
    }

    /**
     * 检查窗口是否可调整大小
     *
     * @return bool
     */
    public function isResizable(): bool
    {
        return LibuiWindow::resizable($this->window);
    }

    /**
     * 显示窗口
     *
     * @return void
     */
    public function show(): void
    {
        LibuiControl::show($this->window);
    }

    /**
     * 隐藏窗口
     *
     * @return void
     */
    public function hide(): void
    {
        LibuiControl::hide($this->window);
    }

    /**
     * 获取底层的 FFI 窗口句柄 (仅供内部使用)
     *
     * @return CData
     */
    public function getHandle(): CData
    {
        return $this->window;
    }

    /**
     * 当窗口关闭时触发的事件
     *
     * @param callable $callback 回调函数，返回 bool 值决定是否关闭窗口
     * @return void
     */
    public function onClose(callable $callback): void
    {
        LibuiWindow::onClosing($this->window, function ($window) use ($callback) {
            $result = $callback($this);
            return $result ? 1 : 0;
        });
    }

    /**
     * 当窗口内容大小改变时触发的事件
     *
     * @param callable $callback 回调函数
     * @return void
     */
    public function onSizeChanged(callable $callback): void
    {
        LibuiWindow::onContentSizeChanged($this->window, function ($window) use ($callback) {
            $callback($this);
        });
    }

    /**
     * 打开文件对话框
     *
     * @return string|null 选中的文件路径，如果用户取消则返回 null
     */
    public function openFile(): ?string
    {
        $path = LibuiWindow::openFile($this->window);
        return $path === '' ? null : $path;
    }

    /**
     * 保存文件对话框
     *
     * @return string|null 选中的文件路径，如果用户取消则返回 null
     */
    public function saveFile(): ?string
    {
        $path = LibuiWindow::saveFile($this->window);
        return $path === '' ? null : $path;
    }

    /**
     * 显示一个消息框
     *
     * @param string $title 标题
     * @param string $message 消息内容
     * @return void
     */
    public function msgBox(string $title, string $message): void
    {
        LibuiWindow::msgBox($this->window, $title, $message);
    }

    /**
     * 显示一个错误消息框
     *
     * @param string $title 标题
     * @param string $message 错误信息
     * @return void
     */
    public function msgBoxError(string $title, string $message): void
    {
        LibuiWindow::msgBoxError($this->window, $title, $message);
    }
}