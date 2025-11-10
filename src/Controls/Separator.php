<?php

namespace UI\Controls;

use UI\Control;
use Kingbes\Libui\Separator as LibuiSeparator;
use FFI\CData;

/**
 * Separator 控件
 */
class Separator extends Control
{
    /**
     * @var CData 分隔符句柄
     */
    protected CData $separator;

    /**
     * @var bool 是否水平分隔符
     */
    protected bool $horizontal = true;

    /**
     * 构造一个新的水平分隔符
     */
    public function __construct()
    {
        $this->horizontal = true;
        $this->separator = LibuiSeparator::createHorizontal();
    }

    /**
     * 创建水平分隔符
     *
     * @return Separator
     */
    public static function createHorizontal(): Separator
    {
        $separator = new self();
        $separator->horizontal = true;
        $separator->separator = LibuiSeparator::createHorizontal();
        return $separator;
    }

    /**
     * 创建垂直分隔符
     *
     * @return Separator
     */
    public static function createVertical(): Separator
    {
        $separator = new self();
        $separator->horizontal = false;
        $separator->separator = LibuiSeparator::createVertical();
        return $separator;
    }

    /**
     * 检查是否为水平分隔符
     *
     * @return bool
     */
    public function isHorizontal(): bool
    {
        return $this->horizontal;
    }

    /**
     * 检查是否为垂直分隔符
     *
     * @return bool
     */
    public function isVertical(): bool
    {
        return !$this->horizontal;
    }

    /**
     * 显示控件
     *
     * @return void
     */
    public function show(): void
    {
        // 实现显示逻辑
    }

    /**
     * 隐藏控件
     *
     * @return void
     */
    public function hide(): void
    {
        // 实现隐藏逻辑
    }

    /**
     * 获取底层的 FFI 控件句柄 (仅供内部使用)
     *
     * @return CData
     */
    public function getHandle(): CData
    {
        return $this->separator;
    }
}