<?php

namespace UI\Controls;

use UI\Control;
use Kingbes\Libui\Form as LibuiForm;
use FFI\CData;

/**
 * Form 控件
 */
class Form extends Control
{
    /**
     * @var CData 表单句柄
     */
    protected CData $form;

    /**
     * @var bool 是否填充
     */
    protected bool $padded = false;

    /**
     * 构造一个新的表单
     */
    public function __construct()
    {
        $this->form = LibuiForm::create();
    }

    /**
     * 追加表单项
     *
     * @param string $label 标签
     * @param Control $control 控件
     * @param bool $stretchy 是否拉伸
     * @return void
     */
    public function append(string $label, Control $control, bool $stretchy = false): void
    {
        LibuiForm::append($this->form, $label, $control->getHandle(), $stretchy);
    }

    /**
     * 获取表单子控件数量
     *
     * @return int
     */
    public function getNumChildren(): int
    {
        return LibuiForm::numChildren($this->form);
    }

    /**
     * 删除表单项
     *
     * @param int $index 索引
     * @return void
     */
    public function delete(int $index): void
    {
        LibuiForm::delete($this->form, $index);
    }

    /**
     * 判断表单是否填充
     *
     * @return bool
     */
    public function isPadded(): bool
    {
        return LibuiForm::padded($this->form);
    }

    /**
     * 设置表单是否填充
     *
     * @param bool $padded 是否填充
     * @return void
     */
    public function setPadded(bool $padded): void
    {
        $this->padded = $padded;
        LibuiForm::setPadded($this->form, $padded);
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
        return $this->form;
    }
}