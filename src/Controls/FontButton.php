<?php

namespace UI\Controls;

use UI\Control;
use UI\Draw\Text\Font;
use Kingbes\Libui\Button as LibuiButton;
use FFI\CData;

/**
 * FontButton 控件
 * 
 * FontButton 是一个按钮，用于选择字体。
 */
class FontButton extends Control
{
    /**
     * @var CData 字体按钮句柄
     */
    protected CData $button;
    
    /**
     * @var Font 当前字体
     */
    protected Font $font;

    /**
     * 构造一个新的字体按钮
     */
    public function __construct()
    {
        $this->button = LibuiButton::createFont();
        $this->font = new Font("Arial", 12); // 默认字体
    }

    /**
     * 获取当前选择的字体
     *
     * @return Font
     */
    public function getFont(): Font
    {
        // 注意：由于底层库的限制，我们无法直接获取当前选择的字体
        // 这里返回的是默认字体或上次设置的字体
        return $this->font;
    }

    /**
     * 当字体改变时触发的事件
     *
     * @param callable $callback 回调函数，接收 FontButton 实例作为参数
     * @return void
     */
    public function onChange(callable $callback): void
    {
        LibuiButton::onFontChanged($this->button, function ($btn) use ($callback) {
            // 更新内部字体对象
            // 注意：由于底层库的限制，我们无法获取实际选择的字体信息
            // 这里我们保持默认字体不变
            $callback($this);
        });
    }

    /**
     * 显示字体按钮
     *
     * @return void
     */
    public function show(): void
    {
        Kingbes\Libui\Control::show($this->button);
    }

    /**
     * 隐藏字体按钮
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