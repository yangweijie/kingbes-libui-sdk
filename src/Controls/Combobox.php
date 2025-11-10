<?php

namespace UI\Controls;

use UI\Control;
use Kingbes\Libui\Combobox as LibuiCombobox;
use FFI\CData;

/**
 * 下拉列表框控件
 */
class Combobox extends Control
{
    /**
     * @var CData 下拉列表框句柄
     */
    protected CData $combobox;

    /**
     * 构造一个新的下拉列表框
     */
    public function __construct()
    {
        $this->combobox = LibuiCombobox::create();
    }

    /**
     * 向下拉列表框中添加一个选项
     *
     * @param string $text 选项文本
     * @return void
     */
    public function append(string $text): void
    {
        LibuiCombobox::append($this->combobox, $text);
    }

    /**
     * 在指定索引位置插入一个选项
     *
     * @param int $index 索引位置
     * @param string $text 选项文本
     * @return void
     */
    public function insertAt(int $index, string $text): void
    {
        LibuiCombobox::insertAt($this->combobox, $index, $text);
    }

    /**
     * 删除指定索引位置的选项
     *
     * @param int $index 索引位置
     * @return void
     */
    public function delete(int $index): void
    {
        LibuiCombobox::delete($this->combobox, $index);
    }

    /**
     * 清空所有选项
     *
     * @return void
     */
    public function clear(): void
    {
        LibuiCombobox::clear($this->combobox);
    }

    /**
     * 获取选项的数量
     *
     * @return int
     */
    public function count(): int
    {
        return LibuiCombobox::numItems($this->combobox);
    }

    /**
     * 获取当前选中项的索引
     *
     * @return int 选中项索引，如果没有选中项则返回 -1
     */
    public function getSelected(): int
    {
        return LibuiCombobox::selected($this->combobox);
    }

    /**
     * 设置选中项的索引
     *
     * @param int $index 要选中的项的索引
     * @return void
     */
    public function setSelected(int $index): void
    {
        LibuiCombobox::setSelected($this->combobox, $index);
    }

    /**
     * 当选中项改变时触发的事件
     *
     * @param callable $callback 回调函数，接收 Combobox 实例作为参数
     * @return void
     */
    public function onSelected(callable $callback): void
    {
        LibuiCombobox::onSelected($this->combobox, function ($combobox) use ($callback) {
            $callback($this);
        });
    }

    /**
     * 显示下拉列表框
     *
     * @return void
     */
    public function show(): void
    {
        Kingbes\Libui\Control::show($this->combobox);
    }

    /**
     * 隐藏下拉列表框
     *
     * @return void
     */
    public function hide(): void
    {
        Kingbes\Libui\Control::hide($this->combobox);
    }

    /**
     * 获取底层的 FFI 控件句柄
     *
     * @return CData
     */
    public function getHandle(): CData
    {
        return $this->combobox;
    }
}