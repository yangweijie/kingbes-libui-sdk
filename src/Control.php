<?php

namespace UI;

/**
 * 控件基类
 */
abstract class Control
{
    /**
     * 显示控件
     *
     * @return void
     */
    abstract public function show(): void;

    /**
     * 隐藏控件
     *
     * @return void
     */
    abstract public function hide(): void;

    /**
     * 获取底层的 FFI 控件句柄 (仅供内部使用)
     *
     * @return \FFI\CData
     */
    abstract public function getHandle(): \FFI\CData;
}