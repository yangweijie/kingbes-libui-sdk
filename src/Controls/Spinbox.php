<?php

namespace UI\Controls;

use UI\Control;
use Kingbes\Libui\Spinbox as LibuiSpinbox;
use FFI\CData;

/**
 * 微调框控件 (Spinbox)
 */
class Spinbox extends Control
{
    /**
     * @var CData 微调框句柄
     */
    protected CData $spinbox;

    /**
     * 构造一个新的微调框
     *
     * @param int $min 最小值
     * @param int $max 最大值
     */
    public function __construct(int $min, int $max)
    {
        $this->spinbox = LibuiSpinbox::create($min, $max);
    }

    /**
     * 获取微调框的当前值
     *
     * @return int
     */
    public function getValue(): int
    {
        return LibuiSpinbox::value($this->spinbox);
    }

    /**
     * 设置微调框的值
     *
     * @param int $value
     * @return void
     */
    public function setValue(int $value): void
    {
        LibuiSpinbox::setValue($this->spinbox, $value);
    }

    /**
     * 当微调框的值改变时触发的事件
     *
     * @param callable $callback 回调函数
     * @return void
     */
    public function onChange(callable $callback): void
    {
        LibuiSpinbox::onChanged($this->spinbox, function ($spinbox) use ($callback) {
            $callback($this);
        });
    }

    /**
     * 显示微调框
     *
     * @return void
     */
    public function show(): void
    {
        Kingbes\Libui\Control::show($this->spinbox);
    }

    /**
     * 隐藏微调框
     *
     * @return void
     */
    public function hide(): void
    {
        Kingbes\Libui\Control::hide($this->spinbox);
    }

    /**
     * 获取底层的 FFI 控件句柄
     *
     * @return CData
     */
    public function getHandle(): CData
    {
        return $this->spinbox;
    }
}