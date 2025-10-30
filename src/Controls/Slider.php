<?php

namespace UI\Controls;

use UI\Control;
use Kingbes\Libui\Slider as LibuiSlider;
use FFI\CData;

/**
 * 滑块控件
 */
class Slider extends Control
{
    /**
     * @var CData 滑块句柄
     */
    protected CData $slider;

    /**
     * 构造一个新的滑块
     *
     * @param int $min 最小值
     * @param int $max 最大值
     */
    public function __construct(int $min, int $max)
    {
        $this->slider = LibuiSlider::create($min, $max);
    }

    /**
     * 获取滑块的当前值
     *
     * @return int
     */
    public function getValue(): int
    {
        return LibuiSlider::value($this->slider);
    }

    /**
     * 设置滑块的值
     *
     * @param int $value
     * @return void
     */
    public function setValue(int $value): void
    {
        LibuiSlider::setValue($this->slider, $value);
    }

    /**
     * 设置滑块的范围
     *
     * @param int $min 最小值
     * @param int $max 最大值
     * @return void
     */
    public function setRange(int $min, int $max): void
    {
        LibuiSlider::setRange($this->slider, $min, $max);
    }

    /**
     * 检查滑块是否显示工具提示
     *
     * @return bool
     */
    public function hasToolTip(): bool
    {
        return LibuiSlider::hasToolTip($this->slider);
    }

    /**
     * 设置滑块是否显示工具提示
     *
     * @param bool $hasToolTip
     * @return void
     */
    public function setHasToolTip(bool $hasToolTip): void
    {
        LibuiSlider::setHasToolTip($this->slider, $hasToolTip);
    }

    /**
     * 当滑块的值改变时触发的事件
     *
     * @param callable $callback 回调函数
     * @return void
     */
    public function onChange(callable $callback): void
    {
        LibuiSlider::onChanged($this->slider, function ($slider) use ($callback) {
            $callback($this);
        });
    }

    /**
     * 当滑块被释放时触发的事件
     *
     * @param callable $callback 回调函数
     * @return void
     */
    public function onReleased(callable $callback): void
    {
        LibuiSlider::onReleased($this->slider, function ($slider) use ($callback) {
            $callback($this);
        });
    }

    /**
     * 显示滑块
     *
     * @return void
     */
    public function show(): void
    {
        Kingbes\Libui\Control::show($this->slider);
    }

    /**
     * 隐藏滑块
     *
     * @return void
     */
    public function hide(): void
    {
        Kingbes\Libui\Control::hide($this->slider);
    }

    /**
     * 获取底层的 FFI 控件句柄
     *
     * @return CData
     */
    public function getHandle(): CData
    {
        return $this->slider;
    }
}