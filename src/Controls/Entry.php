<?php

namespace UI\Controls;

use UI\Control;
use Kingbes\Libui\Entry as LibuiEntry;
use FFI\CData;

/**
 * Entry 类型常量
 */
class EntryType
{
    const Normal = 0;
    const Password = 1;
    const Search = 2;
}

/**
 * 输入框控件
 */
class Entry extends Control
{
    /**
     * @var CData 输入框句柄
     */
    protected CData $entry;

    /**
     * 构造一个新的输入框
     *
     * @param int $type 输入框类型 (EntryType::Normal, EntryType::Password, EntryType::Search)
     */
    public function __construct(int $type = EntryType::Normal)
    {
        switch ($type) {
            case EntryType::Password:
                $this->entry = LibuiEntry::createPwd();
                break;
            case EntryType::Search:
                $this->entry = LibuiEntry::createSearch();
                break;
            default:
                $this->entry = LibuiEntry::create();
                break;
        }
    }

    /**
     * 获取输入框中的文本
     *
     * @return string
     */
    public function getText(): string
    {
        return LibuiEntry::text($this->entry);
    }

    /**
     * 设置输入框中的文本
     *
     * @param string $text
     * @return void
     */
    public function setText(string $text): void
    {
        LibuiEntry::setText($this->entry, $text);
    }

    /**
     * 当输入框文本改变时触发的事件
     *
     * @param callable $callback 回调函数
     * @return void
     */
    public function onChange(callable $callback): void
    {
        LibuiEntry::onChanged($this->entry, function ($entry) use ($callback) {
            $callback($this);
        });
    }

    /**
     * 检查输入框是否为只读
     *
     * @return bool
     */
    public function isReadOnly(): bool
    {
        return LibuiEntry::readOnly($this->entry);
    }

    /**
     * 设置输入框是否为只读
     *
     * @param bool $readOnly
     * @return void
     */
    public function setReadOnly(bool $readOnly): void
    {
        LibuiEntry::setReadOnly($this->entry, $readOnly);
    }

    /**
     * 显示输入框
     *
     * @return void
     */
    public function show(): void
    {
        Kingbes\Libui\Control::show($this->entry);
    }

    /**
     * 隐藏输入框
     *
     * @return void
     */
    public function hide(): void
    {
        Kingbes\Libui\Control::hide($this->entry);
    }

    /**
     * 获取底层的 FFI 控件句柄
     *
     * @return CData
     */
    public function getHandle(): CData
    {
        return $this->entry;
    }
}