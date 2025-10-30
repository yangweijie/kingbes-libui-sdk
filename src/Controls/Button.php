<?php

namespace UI\Controls;

use UI\Control;
use Kingbes\Libui\Button as LibuiButton;
use FFI\CData;

/**
 * 按钮控件
 */
class Button extends Control
{
    /**
     * @var CData 按钮句柄
     */
    protected CData $button;

    /**
     * 构造一个新的按钮
     *
     * @param string $text 按钮上显示的文本
     */
    public function __construct(string $text)
    {
        $this->button = LibuiButton::create($text);
    }

    /**
     * 获取按钮上显示的文本
     *
     * @return string
     */
    public function getText(): string
    {
        return LibuiButton::text($this->button);
    }

    /**
     * 设置按钮上显示的文本
     *
     * @param string $text
     * @return void
     */
    public function setText(string $text): void
    {
        LibuiButton::setText($this->button, $text);
    }

    /**
     * 当按钮被点击时触发的事件
     *
     * @param callable $callback 回调函数
     * @return void
     */
    public function onClick(callable $callback): void
    {
        LibuiButton::onClicked($this->button, function ($btn) use ($callback) {
            $callback($this);
        });
    }

    /**
     * 显示按钮
     *
     * @return void
     */
    public function show(): void
    {
        Kingbes\Libui\Control::show($this->button);
    }

    /**
     * 隐藏按钮
     *
     * @return void
     */
    public function hide(): void
    {
        Kingbes\Libui\Control::hide($this->button);
    }

    /**
     * 获取底层的 FFI 控件句柄
     *
     * @return CData
     */
    public function getHandle(): CData
    {
        return $this->button;
    }
}