<?php

namespace Kingbes\Libui\SDK;

use FFI\CData;

/**
 * 绘图上下文封装
 */
class LibuiDrawContext
{
    private CData $params;
    private CData $context;

    public function __construct(CData $params) {
        // 重要修复：正确处理 FFI 参数生命周期
        $this->params = $params;
        
        // 验证参数结构完整性 - 使用更安全的方式
        try {
            if (!$params) {
                throw new \RuntimeException("Params is null");
            }
            
            // 检查必需的字段是否存在
            $requiredFields = ['Context', 'AreaWidth', 'AreaHeight'];
            foreach ($requiredFields as $field) {
                if (!property_exists($params, $field)) {
                    throw new \RuntimeException("Missing required field: $field");
                }
            }
            
            // 保存上下文引用，确保在 FFI 调用期间有效
            $this->context = $params;
            
        } catch (\Exception $e) {
            throw new \RuntimeException("Invalid uiAreaDrawParams structure: " . $e->getMessage());
        }
    }

    public function getWidth(): float {
        return $this->params->AreaWidth;
    }

    public function getHeight(): float {
        return $this->params->AreaHeight;
    }

    public function createPath(): LibuiPath {
        return new LibuiPath();
    }

    public function stroke(LibuiPath $path, LibuiBrush $brush, LibuiStrokeParams $stroke): self {
        $ffi = \Kingbes\Libui\Base::ffi();
        
        // 验证参数有效性
        if (!$path || !$brush || !$stroke) {
            throw new \InvalidArgumentException("Invalid path, brush or stroke parameters");
        }
        
        $strokeParams = $stroke->getHandle();
        
        // 关键修复：正确处理FFI调用
        try {
            $ffi->uiDrawStroke($this->context->Context, $path->getHandle(), $brush->getHandle(), \FFI::addr($strokeParams));
        } catch (\FFI\Exception $e) {
            throw new \RuntimeException("FFI stroke call failed: " . $e->getMessage());
        }
        
        return $this;
    }

    public function fill(LibuiPath $path, LibuiBrush $brush): self {
        $ffi = \Kingbes\Libui\Base::ffi();
        
        // 验证参数有效性
        if (!$path || !$brush) {
            throw new \InvalidArgumentException("Invalid path or brush parameters");
        }
        
        // 关键修复：正确处理FFI调用
        try {
            $ffi->uiDrawFill($this->context->Context, $path->getHandle(), $brush->getHandle());
        } catch (\FFI\Exception $e) {
            throw new \RuntimeException("FFI fill call failed: " . $e->getMessage());
        }
        
        return $this;
    }
}
