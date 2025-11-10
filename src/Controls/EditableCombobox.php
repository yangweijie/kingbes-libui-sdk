<?php

namespace UI\Controls;

use UI\Control;
use Kingbes\Libui\EditableCombobox as LibuiEditableCombobox;
use FFI\CData;

/**
 * 可编辑下拉列表框控件
 */
class EditableCombobox extends Control
{
    /**
     * @var CData 可编辑下拉列表框句柄
     */
    protected CData $editableCombobox;

    /**
     * 构造一个新的可编辑下拉列表框
     */
    public function __construct()
    {
        $this->editableCombobox = LibuiEditableCombobox::create();
    }

    /**
     * 向下拉列表中添加一个选项
     *
     * @param string $text 选项文本
     * @return void
     */
    public function append(string $text): void
    {
        LibuiEditableCombobox::append($this->editableCombobox, $text);
    }

    /**
     * 获取当前输入框中的文本
     *
     * @return string
     */
    public function getText(): string
    {
        return LibuiEditableCombobox::text($this->editableCombobox);
    }

    /**
     * 设置输入框中的文本
     *
     * @param string $text
     * @return void
     */
    public function setText(string $text): void
    {
        LibuiEditableCombobox::setText($this->editableCombobox, $text);
    }

    /**
     * 当输入框中的文本改变时触发的事件
     *
     * @param callable $callback 回调函数，接收 EditableCombobox 实例作为参数
     * @return void
     */
    public function onChange(callable $callback): void
    {
        LibuiEditableCombobox::onChanged($this->editableCombobox, function ($editableCombobox) use ($callback) {
            $callback($this);
        });
    }

    /**
     * 显示可编辑下拉列表框
     *
     * @return void
     */
    public function show(): void
    {
        Kingbes\Libui\Control::show($this->editableCombobox);
    }

    /**
     * 隐藏可编辑下拉列表框
     *
     * @return void
     */
    public function hide(): void
    {
        Kingbes\Libui\Control::hide($this->editableCombobox);
    }

    /**
     * 获取底层的 FFI 控件句柄
     *
     * @return CData
     */
    public function getHandle(): CData
    {
        return $this->editableCombobox;
    }
}