<?php

namespace Kingbes\Libui\SDK;

use FFI\CData;
use Kingbes\Libui\Base;

/**
 * 绘图画刷封装
 */
class LibuiBrush
{
    private CData $handle;

    public function __construct(float $r, float $g, float $b, float $a = 1.0) {
        $ffi = Base::ffi();
        $this->handle = $ffi->new("uiDrawBrush");
        $this->handle->Type = 0; // Solid brush
        $this->handle->R = $r;
        $this->handle->G = $g;
        $this->handle->B = $b;
        $this->handle->A = $a;
        
        // 初始化其他字段以避免未定义行为
        $this->handle->X0 = 0.0;
        $this->handle->Y0 = 0.0;
        $this->handle->X1 = 0.0;
        $this->handle->Y1 = 0.0;
        $this->handle->OuterRadius = 0.0;
        $this->handle->Stops = null;
        $this->handle->NumStops = 0;
        
        // 确保所有字段都被正确初始化
        $this->handle->MiterLimit = 10.0;
    }

    public function getHandle(): CData {
        return $this->handle;
    }
}
