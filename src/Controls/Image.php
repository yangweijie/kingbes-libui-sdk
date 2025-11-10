<?php

namespace UI\Controls;

use UI\Control;
use Kingbes\Libui\Image as LibuiImage;
use FFI\CData;

/**
 * 图片控件
 */
class Image extends Control
{
    /**
     * @var CData 图片句柄
     */
    protected CData $image;

    /**
     * @var float 图片宽度
     */
    protected float $width;

    /**
     * @var float 图片高度
     */
    protected float $height;

    /**
     * 构造一个新的图片控件
     *
     * @param float $width 图片宽度
     * @param float $height 图片高度
     */
    public function __construct(float $width, float $height)
    {
        $this->width = $width;
        $this->height = $height;
        $this->image = LibuiImage::create($width, $height);
    }

    /**
     * 追加图片数据
     *
     * @param string $pathFile 图片路径
     * @return void
     */
    public function append(string $pathFile): void
    {
        LibuiImage::append($this->image, $pathFile);
    }

    /**
     * 释放图片
     *
     * @return void
     */
    public function free(): void
    {
        LibuiImage::free($this->image);
    }

    /**
     * 获取图片宽度
     *
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * 获取图片高度
     *
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * 显示控件
     *
     * @return void
     */
    public function show(): void
    {
        Kingbes\Libui\Control::show($this->image);
    }

    /**
     * 隐藏控件
     *
     * @return void
     */
    public function hide(): void
    {
        Kingbes\Libui\Control::hide($this->image);
    }

    /**
     * 获取底层的 FFI 控件句柄
     *
     * @return CData
     */
    public function getHandle(): CData
    {
        return $this->image;
    }
}