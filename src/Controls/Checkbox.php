<?php

namespace UI\Controls;

use UI\Control;
use Kingbes\Libui\Checkbox as LibuiCheckbox;
use FFI\CData;

/**
 * 复选框控件
 */
class Checkbox extends Control
{
    /**
     * @var CData 复选框句柄
     */
    protected CData $checkbox;

    /**
     * 构造一个新的复选框
     *
     * @param string $text 复选框旁边显示的文本
     */
    public function __construct(string $text)
    {
        $this->checkbox = LibuiCheckbox::create($text);
    }

    /**
     * 获取复选框旁边显示的文本
     *
     * @return string
     */
    public function getText(): string
    {
        return LibuiCheckbox::text($this->checkbox);
    }

    /**
     * 设置复选框旁边显示的文本
     *
     * @param string $text
     * @return void
     */
    public function setText(string $text): void
    {
        LibuiCheckbox::setText($this->checkbox, $text);
    }

    /**
     * 当复选框状态切换时触发的事件
     *
     * @param callable $callback 回调函数
     * @return void
     */
    public function onToggle(callable $callback): void
    {
        LibuiCheckbox::onToggled($this->checkbox, function ($checkbox) use ($callback) {
            $callback($this);
        });
    }

    /**
     * 检查复选框是否被选中
     *
     * @return bool
     */
    public function isChecked(): bool
    {
        return LibuiCheckbox::checked($this->checkbox);
    }

    /**
     * 设置复选框是否被选中
     *
     * @param bool $checked
     * @return void
     */
    public function setChecked(bool $checked): void
    {
        LibuiCheckbox::setChecked($this->checkbox, $checked);
    }

    /**
     * 显示复选框
     *
     * @return void
     */
    public function show(): void
    {
        Kingbes\Libui\Control::show($this->checkbox);
    }

    /**
     * 隐藏复选框
     *
     * @return void
     */
    public function hide(): void
    {
        Kingbes\Libui\Control::hide($this->checkbox);
    }

    /**
     * 获取底层的 FFI 控件句柄
     *
     * @return CData
     */
    public function getHandle(): CData
    {
        return $this->checkbox;
    }
}