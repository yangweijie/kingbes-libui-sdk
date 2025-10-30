<?php

namespace UI\Controls;

use UI\Control;
use Kingbes\Libui\Group as LibuiGroup;
use FFI\CData;

/**
 * Group 控件
 */
class Group extends Control
{
    /**
     * @var CData 组句柄
     */
    protected CData $group;

    /**
     * @var string 组标题
     */
    protected string $title;

    /**
     * @var bool 是否有边距
     */
    protected bool $margined = false;

    /**
     * 构造一个新的组
     *
     * @param string $title 组标题
     */
    public function __construct(string $title)
    {
        $this->title = $title;
        $this->group = LibuiGroup::create($title);
    }

    /**
     * 获取组标题
     *
     * @return string
     */
    public function getTitle(): string
    {
        return LibuiGroup::title($this->group);
    }

    /**
     * 设置组标题
     *
     * @param string $title 标题
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
        LibuiGroup::setTitle($this->group, $title);
    }

    /**
     * 设置组子控件
     *
     * @param Control $child 子控件
     * @return void
     */
    public function setChild(Control $child): void
    {
        LibuiGroup::setChild($this->group, $child->getHandle());
    }

    /**
     * 获取组是否有边距
     *
     * @return bool
     */
    public function hasMargin(): bool
    {
        return LibuiGroup::margined($this->group);
    }

    /**
     * 设置组是否有边距
     *
     * @param bool $margined 是否有边距
     * @return void
     */
    public function setMargin(bool $margined): void
    {
        $this->margined = $margined;
        LibuiGroup::setMargined($this->group, $margined);
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
        return $this->group;
    }
}