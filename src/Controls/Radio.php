<?php

namespace UI\Controls;

use UI\Control;
use Kingbes\Libui\Radio as LibuiRadio;
use FFI\CData;

/**
 * 单选框控件组
 */
class Radio extends Control
{
    /**
     * @var CData 单选框句柄
     */
    protected CData $radio;

    /**
     * 构造一个新的单选框组
     */
    public function __construct()
    {
        $this->radio = LibuiRadio::create();
    }

    /**
     * 向单选框组中添加一个选项
     *
     * @param string $text 选项文本
     * @return void
     */
    public function append(string $text): void
    {
        LibuiRadio::append($this->radio, $text);
    }

    /**
     * 获取当前选中项的索引
     *
     * @return int 选中项索引，如果没有选中项则返回 -1
     */
    public function getSelected(): int
    {
        return LibuiRadio::selected($this->radio);
    }

    /**
     * 设置选中项的索引
     *
     * @param int $index 要选中的项的索引
     * @return void
     */
    public function setSelected(int $index): void
    {
        LibuiRadio::setSelected($this->radio, $index);
    }

    /**
     * 当选中项改变时触发的事件
     *
     * @param callable $callback 回调函数，接收 Radio 实例作为参数
     * @return void
     */
    public function onSelected(callable $callback): void
    {
        LibuiRadio::onSelected($this->radio, function ($radio) use ($callback) {
            $callback($this);
        });
    }

    /**
     * 显示单选框组
     *
     * @return void
     */
    public function show(): void
    {
        Kingbes\Libui\Control::show($this->radio);
    }

    /**
     * 隐藏单选框组
     *
     * @return void
     */
    public function hide(): void
    {
        Kingbes\Libui\Control::hide($this->radio);
    }

    /**
     * 获取底层的 FFI 控件句柄
     *
     * @return CData
     */
    public function getHandle(): CData
    {
        return $this->radio;
    }
}