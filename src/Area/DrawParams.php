<?php

namespace UI\Area;

use FFI\CData;

/**
 * DrawParams 类封装了绘图参数
 */
class DrawParams
{
    /**
     * @var CData 底层的绘图参数对象
     */
    private CData $params;

    /**
     * 构造函数
     *
     * @param float $areaWidth 区域宽度
     * @param float $areaHeight 区域高度
     * @param float $clipX 裁剪区域左坐标
     * @param float $clipY 裁剪区域上坐标
     * @param float $clipWidth 裁剪区域宽度
     * @param float $clipHeight 裁剪区域高度
     */
    public function __construct(
        float $areaWidth = 0.0,
        float $areaHeight = 0.0,
        float $clipX = 0.0,
        float $clipY = 0.0,
        float $clipWidth = 0.0,
        float $clipHeight = 0.0
    ) {
        // We don't create the underlying draw params object here
        // It should be passed from the callback
        $this->params = null;
    }

    /**
     * Set the underlying draw parameters object
     *
     * @param CData $params
     * @return void
     */
    public function setParams(CData $params): void
    {
        $this->params = $params;
    }

    /**
     * 获取区域宽度
     *
     * @return float
     */
    public function getAreaWidth(): float
    {
        return $this->params ? $this->params->AreaWidth : 0.0;
    }

    /**
     * 获取区域高度
     *
     * @return float
     */
    public function getAreaHeight(): float
    {
        return $this->params ? $this->params->AreaHeight : 0.0;
    }

    /**
     * 获取裁剪区域左坐标
     *
     * @return float
     */
    public function getClipX(): float
    {
        return $this->params ? $this->params->ClipX : 0.0;
    }

    /**
     * 获取裁剪区域上坐标
     *
     * @return float
     */
    public function getClipY(): float
    {
        return $this->params ? $this->params->ClipY : 0.0;
    }

    /**
     * 获取裁剪区域宽度
     *
     * @return float
     */
    public function getClipWidth(): float
    {
        return $this->params ? $this->params->ClipWidth : 0.0;
    }

    /**
     * 获取裁剪区域高度
     *
     * @return float
     */
    public function getClipHeight(): float
    {
        return $this->params ? $this->params->ClipHeight : 0.0;
    }

    /**
     * 获取底层的绘图参数对象
     *
     * @return CData
     */
    public function getParams(): CData
    {
        return $this->params[0]->Context;
    }
}