<?php

namespace UI\Controls;

use UI\Control;
use Kingbes\Libui\MultilineEntry as LibuiMultilineEntry;
use FFI\CData;

/**
 * MultilineEntry 控件
 */
class MultilineEntry extends Control
{
    /**
     * @var CData 多行文本框句柄
     */
    protected CData $entry;

    /**
     * @var bool 是否只读
     */
    protected bool $readOnly = false;

    /**
     * @var bool 是否换行
     */
    protected bool $wrapping = true;

    /**
     * 构造一个新的多行文本框
     *
     * @param bool $wrapping 是否换行
     */
    public function __construct(bool $wrapping = true)
    {
        $this->wrapping = $wrapping;
        if ($wrapping) {
            $this->entry = LibuiMultilineEntry::create();
        } else {
            $this->entry = LibuiMultilineEntry::createNonWrapping();
        }
    }

    /**
     * 获取文本
     *
     * @return string
     */
    public function getText(): string
    {
        return LibuiMultilineEntry::text($this->entry);
    }

    /**
     * 设置文本
     *
     * @param string $text 文本
     * @return void
     */
    public function setText(string $text): void
    {
        LibuiMultilineEntry::setText($this->entry, $text);
    }

    /**
     * 追加文本
     *
     * @param string $text 文本
     * @return void
     */
    public function append(string $text): void
    {
        LibuiMultilineEntry::append($this->entry, $text);
    }

    /**
     * 文本改变事件
     *
     * @param callable $callback 回调函数
     * @return void
     */
    public function onChanged(callable $callback): void
    {
        LibuiMultilineEntry::onChanged($this->entry, $callback);
    }

    /**
     * 获取是否只读
     *
     * @return bool
     */
    public function isReadOnly(): bool
    {
        return LibuiMultilineEntry::readOnly($this->entry);
    }

    /**
     * 设置是否只读
     *
     * @param bool $readOnly 是否只读
     * @return void
     */
    public function setReadOnly(bool $readOnly): void
    {
        $this->readOnly = $readOnly;
        LibuiMultilineEntry::setReadOnly($this->entry, $readOnly);
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
        return $this->entry;
    }
}