<?php

namespace UI\Controls;

use UI\Control;
use UI\Draw\Color;
use Kingbes\Libui\Button as LibuiButton;
use FFI\CData;

/**
 * ColorButton 控件
 * 
 * ColorButton 是一个按钮，用于显示和选择颜色。
 */
class ColorButton extends Control
{
    /**
     * @var CData 颜色按钮句柄
     */
    protected CData $button;
    
    /**
     * @var Color 当前颜色
     */
    protected Color $color;

    /**
     * 构造一个新的颜色按钮
     */
    public function __construct()
    {
        $this->button = LibuiButton::createColor();
        $this->color = new Color(0.0, 0.0, 0.0, 1.0); // 默认黑色
    }

    /**
     * 获取当前选择的颜色
     *
     * @return Color
     */
    public function getColor(): Color
    {
        $color = LibuiButton::color($this->button);
        return new Color($color->r, $color->g, $color->b, $color->a);
    }

    /**
     * 设置颜色
     *
     * @param Color $color 要设置的颜色
     * @return void
     */
    public function setColor(Color $color): void
    {
        $this->color = $color;
        LibuiButton::setColor($this->button, $color->getR(), $color->getG(), $color->getB(), $color->getA());
    }

    /**
     * 当颜色改变时触发的事件
     *
     * @param callable $callback 回调函数，接收 ColorButton 实例作为参数
     * @return void
     */
    public function onChange(callable $callback): void
    {
        LibuiButton::colorOnChanged($this->button, function ($btn) use ($callback) {
            $callback($this);
        });
    }

    /**
     * 显示颜色按钮
     *
     * @return void
     */
    public function show(): void
    {
        Kingbes\Libui\Control::show($this->button);
    }

    /**
     * 隐藏颜色按钮
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