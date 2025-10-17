<?php

// 全新的 LibuiDrawArea 封装 - 按照我的设计理念重新实现
// 基于 main2_final.php 的成功经验，完全重新设计API

namespace Kingbes\Libui\SDK;

use FFI\CData;
use Kingbes\Libui\Area;
use Kingbes\Libui\Draw;
use Kingbes\Libui\DrawBrushType;
use Kingbes\Libui\DrawFillMode;

/**
 * 全新的绘图区域组件 - 我的设计理念封装
 * 基于 main2_final.php 的成功经验，完全重新设计
 */
class MyLibuiDrawArea extends LibuiComponent
{
    protected ?\FFI\CData $handle = null;
    private $drawHandler = null;
    private $mouseHandler = null;
    private $keyHandler = null;
    private int $width = 400;
    private int $height = 400;
    
    // 我的设计理念：直接保存回调，避免复杂封装
    private array $callbacks = [];

    public function __construct(int $width = 400, int $height = 400) {
        parent::__construct();
        $this->width = $width;
        $this->height = $height;
        $this->handle = $this->createHandle();
    }

    /**
     * 我的设计理念：直接创建句柄，避免复杂的回调包装
     */
    protected function createHandle(): CData {
        // 创建简单的回调，直接转发到用户回调
        $handler = Area::handler(
            function($handler, $area, $params) {
                return $this->handleDraw($handler, $area, $params);
            },
            function($handler, $area, $keyEvent) {
                return $this->handleKey($handler, $area, $keyEvent);
            },
            function($handler, $area, $mouseEvent) {
                return $this->handleMouse($handler, $area, $mouseEvent);
            },
            function($handler, $area, $left) {
                return $this->handleMouseCrossed($handler, $area, $left);
            },
            function($handler, $area) {
                return $this->handleDragBroken($handler, $area);
            }
        );

        return Area::create($handler);
    }

    /**
     * 我的设计理念：直接传递用户回调，避免复杂的闭包捕获
     */
    public function onDraw(callable $callback): self {
        $this->drawHandler = $callback;
        return $this;
    }

    public function onMouse(callable $callback): self {
        $this->mouseHandler = $callback;
        return $this;
    }

    public function onKey(callable $callback): self {
        $this->keyHandler = $callback;
        return $this;
    }

    public function getHandle(): CData {
        return $this->handle;
    }

    public function redraw(): self {
        if ($this->handle) {
            Area::queueRedraw($this->handle);
        }
        return $this;
    }

    /**
     * 我的设计理念：直接传递参数，避免复杂的包装
     */
    private function handleDraw($handler, $area, $params): void {
        if ($this->drawHandler) {
            // 直接传递原始参数，就像 main2_final.php 那样成功
            ($this->drawHandler)($handler, $area, $params);
        }
    }

    private function handleKey($handler, $area, $keyEvent): int {
        if ($this->keyHandler) {
            $result = ($this->keyHandler)($handler, $area, $keyEvent);
            return $result ? 1 : 0;
        }
        return 0;
    }

    private function handleMouse($handler, $area, $mouseEvent): void {
        if ($this->mouseHandler) {
            ($this->mouseHandler)($handler, $area, $mouseEvent);
        }
    }

    private function handleMouseCrossed($handler, $area, $left): void {
        // 预留扩展
    }

    private function handleDragBroken($handler, $area): void {
        // 预留扩展
    }
}

/**
 * 我的设计理念：全新的绘图上下文封装
 * 直接暴露底层功能，避免过度封装
 */
class MyLibuiDrawContext
{
    private CData $params;

    public function __construct(CData $params) {
        $this->params = $params;
    }

    public function getWidth(): float {
        return $this->params->AreaWidth;
    }

    public function getHeight(): float {
        return $this->params->AreaHeight;
    }

    /**
     * 我的设计理念：直接暴露底层绘图功能
     */
    public function fill(CData $path, CData $brush): void {
        Draw::fill($this->params, $path, $brush);
    }

    public function stroke(CData $path, CData $brush, CData $strokeParams): void {
        Draw::stroke($this->params, $path, $brush, $strokeParams);
    }

    /**
     * 我的设计理念：直接返回底层参数，让用户自由使用
     */
    public function getRawParams(): CData {
        return $this->params;
    }
}

/**
 * 我的设计理念：简化的画刷封装
 * 专注于核心功能，避免过度设计
 */
class MyLibuiBrush
{
    private CData $handle;

    public function __construct(float $r, float $g, float $b, float $a = 1.0) {
        $this->handle = Draw::createBrush(DrawBrushType::Solid, $r, $g, $b, $a);
    }

    public function getHandle(): CData {
        return $this->handle;
    }
}

/**
 * 我的设计理念：简化的路径封装
 * 提供基本功能，保持简洁
 */
class MyLibuiPath
{
    private CData $handle;

    public function __construct() {
        $this->handle = Draw::createPath(DrawFillMode::Winding);
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

    public function getHandle(): CData {
        return $this->handle;
    }
}