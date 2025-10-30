<?php

namespace UI\Controls;

use UI\Control;
use Kingbes\Libui\Box as LibuiBox;
use FFI\CData;

/**
 * 方向常量
 */
class Orientation
{
    const Horizontal = 0;
    const Vertical = 1;
}

/**
 * 盒子布局控件 (用于排列其他控件)
 */
class Box extends Control
{
    /**
     * @var CData 盒子句柄
     */
    protected CData $box;

    /**
     * 构造一个新的盒子布局
     *
     * @param int $orientation 方向 (Orientation::Horizontal 或 Orientation::Vertical)
     */
    public function __construct(int $orientation)
    {
        if ($orientation === Orientation::Horizontal) {
            $this->box = LibuiBox::newHorizontalBox();
        } else {
            $this->box = LibuiBox::newVerticalBox();
        }
    }

    /**
     * 向盒子中追加一个控件
     *
     * @param Control $control 要追加的控件
     * @param bool $stretch 是否拉伸控件以填充可用空间
     * @return void
     */
    public function append(Control $control, bool $stretch = false): void
    {
        LibuiBox::append($this->box, $control->getHandle(), $stretch);
    }

    /**
     * 设置盒子是否有内边距
     *
     * @param bool $padded
     * @return void
     */
    public function setPadded(bool $padded): void
    {
        LibuiBox::setPadded($this->box, $padded);
    }

    /**
     * 检查盒子是否有内边距
     *
     * @return bool
     */
    public function isPadded(): bool
    {
        return LibuiBox::padded($this->box);
    }

    /**
     * 显示盒子
     *
     * @return void
     */
    public function show(): void
    {
        Kingbes\Libui\Control::show($this->box);
    }

    /**
     * 隐藏盒子
     *
     * @return void
     */
    public function hide(): void
    {
        Kingbes\Libui\Control::hide($this->box);
    }

    /**
     * 获取底层的 FFI 控件句柄
     *
     * @return CData
     */
    public function getHandle(): CData
    {
        return $this->box;
    }
}