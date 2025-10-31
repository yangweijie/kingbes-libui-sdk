<?php

namespace UI;

use Kingbes\Libui\Control as LibuiControl;

/**
 * 控件基类
 */
abstract class Control
{
    /**
     * 销毁控件
     *
     * @return void
     */
    public function destroy(): void
    {
        LibuiControl::destroy($this->getHandle());
    }

    /**
     * 禁用控件
     *
     * @return void
     */
    public function disable(): void
    {
        LibuiControl::disable($this->getHandle());
    }

    /**
     * 启用控件
     *
     * @return void
     */
    public function enable(): void
    {
        LibuiControl::enable($this->getHandle());
    }

    /**
     * 获取控件父容器
     *
     * @return UI\Control|null
     */
    public function getParent(): ?Control
    {
        // 注意：这个方法需要具体控件类实现，因为需要将 CData 转换为具体的 UI\Control 对象
        // 这里提供一个基本实现，但具体控件类可能需要重写
        return null;
    }

    /**
     * 获取控件等级
     *
     * @return int
     */
    public function getTopLevel(): int
    {
        return LibuiControl::topLevel($this->getHandle());
    }

    /**
     * 隐藏控件
     *
     * @return void
     */
    abstract public function hide(): void;

    /**
     * 检查控件是否启用
     *
     * @return bool
     */
    public function isEnabled(): bool
    {
        return LibuiControl::enabled($this->getHandle());
    }

    /**
     * 检查控件是否可见
     *
     * @return bool
     */
    public function isVisible(): bool
    {
        return LibuiControl::visible($this->getHandle());
    }

    /**
     * 设置控件父容器
     *
     * @param UI\Control $parent 父容器
     * @return void
     */
    public function setParent(Control $parent): void
    {
        LibuiControl::setParent($this->getHandle(), $parent->getHandle());
    }

    /**
     * 显示控件
     *
     * @return void
     */
    abstract public function show(): void;

    /**
     * 获取底层的 FFI 控件句柄 (仅供内部使用)
     *
     * @return \FFI\CData
     */
    abstract public function getHandle(): \FFI\CData;
}