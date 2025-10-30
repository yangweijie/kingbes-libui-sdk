<?php

namespace UI\Controls;

use UI\Control;
use Kingbes\Libui\Tab as LibuiTab;
use FFI\CData;

/**
 * 标签页控件
 */
class Tab extends Control
{
    /**
     * @var CData 标签页句柄
     */
    protected CData $tab;

    /**
     * 构造一个新的标签页控件
     */
    public function __construct()
    {
        $this->tab = LibuiTab::create();
    }

    /**
     * 向标签页控件中追加一个新的页面
     *
     * @param string $name 页面标题
     * @param Control $control 页面内容控件
     * @return void
     */
    public function append(string $name, Control $control): void
    {
        LibuiTab::append($this->tab, $name, $control->getHandle());
    }

    /**
     * 在指定位置插入一个新的页面
     *
     * @param string $name 页面标题
     * @param int $before 插入位置的索引
     * @param Control $control 页面内容控件
     * @return void
     */
    public function insertAt(string $name, int $before, Control $control): void
    {
        LibuiTab::insertAt($this->tab, $name, $before, $control->getHandle());
    }

    /**
     * 删除指定索引的页面
     *
     * @param int $index 页面索引
     * @return void
     */
    public function delete(int $index): void
    {
        LibuiTab::delete($this->tab, $index);
    }

    /**
     * 获取页面的数量
     *
     * @return int
     */
    public function pages(): int
    {
        return LibuiTab::numPages($this->tab);
    }

    /**
     * 获取当前选中的页面索引
     *
     * @return int
     */
    public function getSelected(): int
    {
        return LibuiTab::selected($this->tab);
    }

    /**
     * 设置当前选中的页面索引
     *
     * @param int $index 页面索引
     * @return void
     */
    public function setSelected(int $index): void
    {
        LibuiTab::setSelected($this->tab, $index);
    }

    /**
     * 检查指定页面是否有边距
     *
     * @param int $page 页面索引
     * @return bool
     */
    public function hasMargin(int $page): bool
    {
        // 注意：libui 的 FFI 接口返回的是 int，这里转换为 bool
        return (bool) LibuiTab::margined($this->tab, $page);
    }

    /**
     * 设置指定页面是否有边距
     *
     * @param int $page 页面索引
     * @param bool $margin 是否有边距
     * @return void
     */
    public function setMargin(int $page, bool $margin): void
    {
        LibuiTab::setMargined($this->tab, $page, $margin);
    }

    /**
     * 当选中的页面改变时触发的事件
     *
     * @param callable $callback 回调函数，接收 Tab 实例和选中的页面索引作为参数
     * @return void
     */
    public function onSelected(callable $callback): void
    {
        LibuiTab::onSelected($this->tab, function ($tab) use ($callback) {
            $selectedIndex = LibuiTab::selected($tab);
            $callback($this, $selectedIndex);
        });
    }

    /**
     * 显示标签页控件
     *
     * @return void
     */
    public function show(): void
    {
        Kingbes\Libui\Control::show($this->tab);
    }

    /**
     * 隐藏标签页控件
     *
     * @return void
     */
    public function hide(): void
    {
        Kingbes\Libui\Control::hide($this->tab);
    }

    /**
     * 获取底层的 FFI 控件句柄
     *
     * @return CData
     */
    public function getHandle(): CData
    {
        return $this->tab;
    }
}