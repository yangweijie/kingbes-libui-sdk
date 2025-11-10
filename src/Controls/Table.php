<?php

namespace UI\Controls;

use UI\Control;
use Kingbes\Libui\Table as LibuiTable;
use Kingbes\Libui\TableValueType;
use Kingbes\Libui\TableSelectionMode;
use Kingbes\Libui\SortIndicator;
use FFI\CData;

/**
 * 表格控件
 */
class Table extends Control
{
    /**
     * @var CData 表格句柄
     */
    protected CData $table;

    /**
     * @var CData 表格模型
     */
    protected CData $model;

    /**
     * @var CData 表格模型处理程序
     */
    protected CData $handler;

    /**
     * 构造一个新的表格
     *
     * @param int $numColumns 列数
     * @param TableValueType $columnType 列类型
     * @param int $numRows 行数
     * @param callable $cellValue 单元格值回调函数
     * @param callable|null $setCellValue 设置单元格值回调函数
     * @param int $rowBackgroundColorModelColumn 行背景颜色模型列
     */
    public function __construct(
        int $numColumns,
        TableValueType $columnType,
        int $numRows,
        callable $cellValue,
        callable $setCellValue = null,
        int $rowBackgroundColorModelColumn = -1
    ) {
        // 创建表格模型处理程序
        $this->handler = LibuiTable::modelHandler(
            $numColumns,
            $columnType,
            $numRows,
            $cellValue,
            $setCellValue
        );

        // 创建表格模型
        $this->model = LibuiTable::createModel($this->handler);

        // 创建表格
        $this->table = LibuiTable::create($this->model, $rowBackgroundColorModelColumn);
    }

    /**
     * 追加文本列
     *
     * @param string $name 列名称
     * @param int $textModelColumn 文本模型列
     * @param bool $textEditableModelColumn 文本可编辑模型列
     * @param bool $textParams 文本参数
     * @return void
     */
    public function appendTextColumn(
        string $name,
        int $textModelColumn,
        bool $textEditableModelColumn = false,
        bool $textParams = false
    ): void {
        LibuiTable::appendTextColumn(
            $this->table,
            $name,
            $textModelColumn,
            $textEditableModelColumn,
            $textParams
        );
    }

    /**
     * 追加图片列
     *
     * @param string $name 列名称
     * @param int $imageModelColumn 图片模型列
     * @return void
     */
    public function appendImageColumn(string $name, int $imageModelColumn): void
    {
        LibuiTable::appendImageColumn($this->table, $name, $imageModelColumn);
    }

    /**
     * 追加复选框列
     *
     * @param string $name 列名称
     * @param int $checkboxModelColumn 复选框模型列
     * @param bool $checkboxEditableModelColumn 复选框可编辑模型列
     * @return void
     */
    public function appendCheckboxColumn(
        string $name,
        int $checkboxModelColumn,
        bool $checkboxEditableModelColumn = false
    ): void {
        LibuiTable::appendCheckboxColumn(
            $this->table,
            $name,
            $checkboxModelColumn,
            $checkboxEditableModelColumn
        );
    }

    /**
     * 追加进度条列
     *
     * @param string $name 列名称
     * @param int $progressBarModelColumn 进度条模型列
     * @return void
     */
    public function appendProgressBarColumn(string $name, int $progressBarModelColumn): void
    {
        LibuiTable::appendProgressBarColumn($this->table, $name, $progressBarModelColumn);
    }

    /**
     * 追加按钮列
     *
     * @param string $name 列名称
     * @param int $buttonModelColumn 按钮模型列
     * @param bool $buttonClickableModelColumn 按钮可点击模型列
     * @return void
     */
    public function appendButtonColumn(
        string $name,
        int $buttonModelColumn,
        bool $buttonClickableModelColumn
    ): void {
        LibuiTable::appendButtonColumn(
            $this->table,
            $name,
            $buttonModelColumn,
            $buttonClickableModelColumn
        );
    }

    /**
     * 表格模型行插入
     *
     * @param int $row 行索引
     * @return void
     */
    public function modelRowInserted(int $row): void
    {
        LibuiTable::modelRowInserted($this->model, $row);
    }

    /**
     * 表格模型行改变
     *
     * @param int $row 行索引
     * @return void
     */
    public function modelRowChanged(int $row): void
    {
        LibuiTable::modelRowChanged($this->model, $row);
    }

    /**
     * 表格模型行删除
     *
     * @param int $row 行索引
     * @return void
     */
    public function modelRowDeleted(int $row): void
    {
        LibuiTable::modelRowDeleted($this->model, $row);
    }

    /**
     * 设置表格是否显示标题
     *
     * @param bool $visible 是否显示标题
     * @return void
     */
    public function setHeaderVisible(bool $visible): void
    {
        LibuiTable::setHeaderVisible($this->table, $visible);
    }

    /**
     * 检查表格是否显示标题
     *
     * @return bool
     */
    public function isHeaderVisible(): bool
    {
        return LibuiTable::headerVisible($this->table);
    }

    /**
     * 设置表格标题排序指示器
     *
     * @param int $column 列索引
     * @param SortIndicator $direction 排序方向
     * @return void
     */
    public function setHeaderSortIndicator(int $column, SortIndicator $direction): void
    {
        LibuiTable::setHeaderSortIndicator($this->table, $column, $direction);
    }

    /**
     * 获取表格标题排序指示器
     *
     * @param int $column 列索引
     * @return SortIndicator
     */
    public function getHeaderSortIndicator(int $column): SortIndicator
    {
        return LibuiTable::headerSortIndicator($this->table, $column);
    }

    /**
     * 设置表格列宽度
     *
     * @param int $column 列索引
     * @param int $width 列宽度
     * @return void
     */
    public function setColumnWidth(int $column, int $width): void
    {
        LibuiTable::setColumnWidth($this->table, $column, $width);
    }

    /**
     * 获取表格列宽度
     *
     * @param int $column 列索引
     * @return int
     */
    public function getColumnWidth(int $column): int
    {
        return LibuiTable::columnWidth($this->table, $column);
    }

    /**
     * 设置表格选择模式
     *
     * @param TableSelectionMode $mode 选择模式
     * @return void
     */
    public function setSelectionMode(TableSelectionMode $mode): void
    {
        LibuiTable::setSelectionMode($this->table, $mode);
    }

    /**
     * 获取表格选择模式
     *
     * @return TableSelectionMode
     */
    public function getSelectionMode(): TableSelectionMode
    {
        return LibuiTable::selectionMode($this->table);
    }

    /**
     * 表格行点击事件
     *
     * @param callable $callback 回调函数
     * @return void
     */
    public function onRowClicked(callable $callback): void
    {
        LibuiTable::onRowClicked($this->table, function ($table, $row) use ($callback) {
            $callback($this, $row);
        });
    }

    /**
     * 表格行双击事件
     *
     * @param callable $callback 回调函数
     * @return void
     */
    public function onRowDoubleClicked(callable $callback): void
    {
        LibuiTable::onRowDoubleClicked($this->table, function ($table, $row) use ($callback) {
            $callback($this, $row);
        });
    }

    /**
     * 表格标题点击事件
     *
     * @param callable $callback 回调函数
     * @return void
     */
    public function onHeaderClicked(callable $callback): void
    {
        LibuiTable::onHeaderClicked($this->table, function ($table, $column) use ($callback) {
            $callback($this, $column);
        });
    }

    /**
     * 表格选择改变事件
     *
     * @param callable $callback 回调函数
     * @return void
     */
    public function onSelectionChanged(callable $callback): void
    {
        LibuiTable::onSelectionChanged($this->table, function ($table) use ($callback) {
            $callback($this);
        });
    }

    /**
     * 显示表格
     *
     * @return void
     */
    public function show(): void
    {
        Kingbes\Libui\Control::show($this->table);
    }

    /**
     * 隐藏表格
     *
     * @return void
     */
    public function hide(): void
    {
        Kingbes\Libui\Control::hide($this->table);
    }

    /**
     * 获取底层的 FFI 控件句柄
     *
     * @return CData
     */
    public function getHandle(): CData
    {
        return $this->table;
    }
}