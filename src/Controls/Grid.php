<?php

namespace UI\Controls;

use Kingbes\Libui\Align;
use UI\Control;
use Kingbes\Libui\Grid as LibuiGrid;
use Kingbes\Libui\Align as LibuiAlign;
use Kingbes\Libui\At as LibuiAt;
use FFI\CData;

/**
 * Grid 控件
 */
class Grid extends Control
{

    /* 常量 */
    const int Fill = 0;
    const int Start = 1;
    const int Center = 2;
    const int End = 3;
    const int Leading = 0;
    const int Top = 1;
    const int Trailing = 2;
    const int Bottom = 3;

    public static $VALIGN;

    /**
     * @var CData 网格句柄
     */
    protected CData $grid;

    /**
     * @var bool 是否有内边距
     */
    protected bool $padded = false;

    /**
     * 构造一个新的网格布局
     */
    public function __construct()
    {
        $this->grid = LibuiGrid::create();

    }

    /**
     * 追加控件到网格布局
     *
     * @param Control $control 要添加的控件
     * @param int $left 左列索引
     * @param int $top 顶行索引
     * @param int $xspan 水平跨度（列数）
     * @param int $yspan 垂直跨度（行数）
     * @param bool $hexpand 是否水平扩展
     * @param int $halign 水平对齐方式 (0=Fill, 1=Start, 2=Center, 3=End)
     * @param bool $vexpand 是否垂直扩展
     * @param int $valign 垂直对齐方式 (0=Fill, 1=Start, 2=Center, 3=End)
     * @return void
     */
    public function append(
        Control $control,
        int $left,
        int $top,
        int $xspan = 1,
        int $yspan = 1,
        bool $hexpand = false,
        int $halign = 0,
        bool $vexpand = false,
        int $valign = 0
    ): void {
        LibuiGrid::append(
            $this->grid,
            $control->getHandle(),
            $left,
            $top,
            $xspan,
            $yspan,
            $hexpand ? 1 : 0,
            $halign,  // 直接传递 int 值
            $vexpand ? 1 : 0,
            LibuiAlign::from($valign)  // 转换为枚举
        );
    }

    /**
     * 插入控件到网格布局
     *
     * @param Control $control 要插入的控件
     * @param Control $existing 已存在的控件
     * @param int $at 插入位置 (0=Leading, 1=Top, 2=Trailing, 3=Bottom)
     * @param int $xspan 水平跨度（列数）
     * @param int $yspan 垂直跨度（行数）
     * @param bool $hexpand 是否水平扩展
     * @param int $halign 水平对齐方式 (0=Fill, 1=Start, 2=Center, 3=End)
     * @param bool $vexpand 是否垂直扩展
     * @param int $valign 垂直对齐方式 (0=Fill, 1=Start, 2=Center, 3=End)
     * @return void
     */
    public function insertAt(
        Control $control,
        Control $existing,
        int $at,
        int $xspan = 1,
        int $yspan = 1,
        bool $hexpand = false,
        int $halign = 0,
        bool $vexpand = false,
        int $valign = 0
    ): void {
        LibuiGrid::insertAt(
            $this->grid,
            $control->getHandle(),
            $existing->getHandle(),
            LibuiAt::from($at),
            $xspan,
            $yspan,
            $hexpand ? 1 : 0,
            LibuiAlign::from($halign),  // 转换为枚举
            $vexpand ? 1 : 0,
            LibuiAlign::from($valign)   // 转换为枚举
        );
    }

    /**
     * 获取网格布局是否有内边距
     *
     * @return bool
     */
    public function isPadded(): bool
    {
        return LibuiGrid::padded($this->grid);
    }

    /**
     * 设置网格布局是否有内边距
     *
     * @param bool $padded 是否有内边距
     * @return void
     */
    public function setPadded(bool $padded): void
    {
        $this->padded = $padded;
        LibuiGrid::setPadded($this->grid, $padded);
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
        return $this->grid;
    }
}