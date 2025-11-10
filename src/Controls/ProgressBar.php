<?php

namespace UI\Controls;

use UI\Control;
use Kingbes\Libui\ProgressBar as LibuiProgressBar;
use FFI\CData;

/**
 * 进度条控件
 */
class ProgressBar extends Control
{
    /**
     * @var CData 进度条句柄
     */
    protected CData $progressBar;

    /**
     * 构造一个新的进度条
     */
    public function __construct()
    {
        $this->progressBar = LibuiProgressBar::create();
    }

    /**
     * 获取进度条的当前值
     *
     * @return int (0-100)
     */
    public function getValue(): int
    {
        return LibuiProgressBar::value($this->progressBar);
    }

    /**
     * 设置进度条的值
     *
     * @param int $value (0-100)
     * @return void
     */
    public function setValue(int $value): void
    {
        // 确保值在 0-100 范围内
        $value = max(0, min(100, $value));
        LibuiProgressBar::setValue($this->progressBar, $value);
    }

    /**
     * 显示进度条
     *
     * @return void
     */
    public function show(): void
    {
        Kingbes\Libui\Control::show($this->progressBar);
    }

    /**
     * 隐藏进度条
     *
     * @return void
     */
    public function hide(): void
    {
        Kingbes\Libui\Control::hide($this->progressBar);
    }

    /**
     * 获取底层的 FFI 控件句柄
     *
     * @return CData
     */
    public function getHandle(): CData
    {
        return $this->progressBar;
    }
}