<?php

namespace UI\Area;

use Kingbes\Libui\Area as LibuiArea;
use Kingbes\Libui\Draw as LibuiDraw;
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
     * @var object 绘图上下文
     */
    private object $context;

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
        // 创建底层的绘图参数对象
        $this->params = LibuiArea::createDrawParams(
            $areaWidth,
            $areaHeight,
            $clipX,
            $clipY,
            $clipWidth,
            $clipHeight
        );
        
        // 创建绘图上下文（这里需要根据实际情况调整）
        // 暂时使用一个简单的对象来表示上下文
        $this->context = new class {
            public function fill($path, $brush) {
                // 这里应该调用实际的绘图函数
                // 暂时只是示例
                echo "Filling path with brush\n";
            }
        };
    }

    /**
     * 获取区域宽度
     *
     * @return float
     */
    public function getAreaWidth(): float
    {
        return $this->params->AreaWidth;
    }

    /**
     * 获取区域高度
     *
     * @return float
     */
    public function getAreaHeight(): float
    {
        return $this->params->AreaHeight;
    }

    /**
     * 获取裁剪区域左坐标
     *
     * @return float
     */
    public function getClipX(): float
    {
        return $this->params->ClipX;
    }

    /**
     * 获取裁剪区域上坐标
     *
     * @return float
     */
    public function getClipY(): float
    {
        return $this->params->ClipY;
    }

    /**
     * 获取裁剪区域宽度
     *
     * @return float
     */
    public function getClipWidth(): float
    {
        return $this->params->ClipWidth;
    }

    /**
     * 获取裁剪区域高度
     *
     * @return float
     */
    public function getClipHeight(): float
    {
        return $this->params->ClipHeight;
    }

    /**
     * 获取绘图上下文
     *
     * @return object
     */
    public function getContext(): object
    {
        return $this->context;
    }

    /**
     * 获取底层的绘图参数对象
     *
     * @return CData
     */
    public function getParams(): CData
    {
        return $this->params;
    }
}
