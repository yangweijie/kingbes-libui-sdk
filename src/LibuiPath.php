<?php

namespace Kingbes\Libui\SDK;

use FFI\CData;
use Kingbes\Libui\Draw;

/**
 * 绘图路径封装
 */
class LibuiPath
{
    private CData $handle;

    public function __construct() {
        $this->handle = Draw::createPath(\Kingbes\Libui\DrawFillMode::Winding);
    }

    public function getHandle(): CData {
        return $this->handle;
    }

    public function newFigure(float $x, float $y): self {
        Draw::createPathFigure($this->handle, $x, $y);
        return $this;
    }

    public function lineTo(float $x, float $y): self {
        Draw::pathLineTo($this->handle, $x, $y);
        return $this;
    }

    public function rectangle(float $x, float $y, float $width, float $height): self {
        Draw::pathAddRectangle($this->handle, $x, $y, $width, $height);
        return $this;
    }

    public function arc(float $xCenter, float $yCenter, float $radius, float $startAngle, float $sweep, bool $negative = false): self {
        Draw::createPathFigureWithArc($this->handle, $xCenter, $yCenter, $radius, $startAngle, $sweep, $negative);
        return $this;
    }

    public function end(): self {
        Draw::pathEnd($this->handle);
        return $this;
    }

    public function __destruct() {
        // 不在析构函数中释放路径，避免重复释放内存的问题
    }
}
