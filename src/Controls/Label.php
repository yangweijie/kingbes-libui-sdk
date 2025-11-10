<?php

namespace UI\Controls;

use UI\Control;
use Kingbes\Libui\Label as LibuiLabel;
use FFI\CData;

/**
 * 标签控件
 */
class Label extends Control
{
    /**
     * @var CData 标签句柄
     */
    protected CData $label;

    /**
     * 构造一个新的标签
     *
     * @param string $text 标签上显示的文本
     */
    public function __construct(string $text)
    {
        $this->label = LibuiLabel::create($text);
    }

    /**
     * 获取标签上显示的文本
     *
     * @return string
     */
    public function getText(): string
    {
        return LibuiLabel::text($this->label);
    }

    /**
     * 设置标签上显示的文本
     *
     * @param string $text
     * @return void
     */
    public function setText(string $text): void
    {
        LibuiLabel::setText($this->label, $text);
    }

    /**
     * 显示标签
     *
     * @return void
     */
    public function show(): void
    {
        Kingbes\Libui\Control::show($this->label);
    }

    /**
     * 隐藏标签
     *
     * @return void
     */
    public function hide(): void
    {
        Kingbes\Libui\Control::hide($this->label);
    }

    /**
     * 获取底层的 FFI 控件句柄
     *
     * @return CData
     */
    public function getHandle(): CData
    {
        return $this->label;
    }
}