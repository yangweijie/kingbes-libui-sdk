<?php

namespace UI\Controls;

use UI\Control;
use Kingbes\Libui\DateTimePicker as LibuiDateTimePicker;
use Kingbes\Libui\DateTime as LibuiDateTime;
use FFI\CData;

/**
 * DateTimePicker 控件
 */
class DateTimePicker extends Control
{
    /**
     * @var CData 日期时间选择器句柄
     */
    protected CData $picker;

    /**
     * @var int 选择器类型 (0=DateTime, 1=Date, 2=Time)
     */
    protected int $type = 0;

    /**
     * 构造一个新的日期时间选择器
     *
     * @param int $type 选择器类型 (0=DateTime, 1=Date, 2=Time)
     */
    public function __construct(int $type = 0)
    {
        $this->type = $type;
        switch ($type) {
            case 1:
                $this->picker = LibuiDateTimePicker::createDate();
                break;
            case 2:
                $this->picker = LibuiDateTimePicker::createTime();
                break;
            default:
                $this->picker = LibuiDateTimePicker::createDataTime();
                break;
        }
    }

    /**
     * 获取时间
     *
     * @return LibuiDateTime
     */
    public function getTime(): LibuiDateTime
    {
        return LibuiDateTimePicker::time($this->picker);
    }

    /**
     * 设置时间
     *
     * @param LibuiDateTime $time 时间
     * @return void
     */
    public function setTime(LibuiDateTime $time): void
    {
        LibuiDateTimePicker::setTime($this->picker, $time);
    }

    /**
     * 时间改变事件
     *
     * @param callable $callback 回调函数
     * @return void
     */
    public function onChanged(callable $callback): void
    {
        LibuiDateTimePicker::onChanged($this->picker, $callback);
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
        return $this->picker;
    }
}