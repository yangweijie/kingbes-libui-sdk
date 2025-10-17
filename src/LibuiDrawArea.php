<?php

namespace Kingbes\Libui\SDK;

use FFI\CData;
use Kingbes\Libui\Area;

/**
 * 绘图区域组件
 */
class LibuiDrawArea extends LibuiComponent
{
    protected ?\FFI\CData $handle = null;
    private $drawHandler = null;
    private $mouseHandler = null;
    private $keyHandler = null;
    private int $width = 400;
    private int $height = 400;
    
    // 保存回调引用以防止垃圾回收
    private array $callbackRefs = [];

    public function __construct(int $width = 400, int $height = 400) {
        parent::__construct();
        $this->width = $width;
        $this->height = $height;
        $this->handle = $this->createHandle();
    }

    protected function createHandle(): CData {
        // 修复：确保回调函数在FFI调用期间保持有效
        $emptyCallback = function() {};
        $emptyIntCallback = function() { return 0; };
        
        // 保存回调引用到实例变量，防止垃圾回收
        $this->callbackRefs['draw_empty'] = $emptyCallback;
        $this->callbackRefs['key_empty'] = $emptyIntCallback;
        $this->callbackRefs['mouse_empty'] = $emptyCallback;
        
        // 获取用户回调或空回调
        $drawCallback = $this->getDrawCallback() ?: $emptyCallback;
        $keyCallback = $this->getKeyCallback() ?: $emptyIntCallback;
        $mouseCallback = $this->getMouseCallback() ?: $emptyCallback;
        
        // 保存实际使用的回调
        $this->callbackRefs['draw_actual'] = $drawCallback;
        $this->callbackRefs['key_actual'] = $keyCallback;
        $this->callbackRefs['mouse_actual'] = $mouseCallback;
        
        // 创建处理程序 - 使用保存的回调引用
        $handler = \Kingbes\Libui\Area::handler(
            $this->callbackRefs['draw_actual'],
            $this->callbackRefs['key_actual'],
            $this->callbackRefs['mouse_actual'],
            $this->callbackRefs['draw_empty'], // MouseCrossed
            $this->callbackRefs['draw_empty']  // DragBroken
        );

        return \Kingbes\Libui\Area::create($handler);
    }

    public function onDraw(callable $callback): self {
        $this->drawHandler = $callback;
        // 保存回调引用以防止垃圾回收
        $this->callbackRefs['draw'] = $callback;
        return $this;
    }

    public function onMouse(callable $callback): self {
        $this->mouseHandler = $callback;
        // 保存回调引用以防止垃圾回收
        $this->callbackRefs['mouse'] = $callback;
        return $this;
    }

    public function onKey(callable $callback): self {
        $this->keyHandler = $callback;
        // 保存回调引用以防止垃圾回收
        $this->callbackRefs['key'] = $callback;
        return $this;
    }

    public function setSize(int $width, int $height): self {
        $this->width = $width;
        $this->height = $height;
        Area::setSize($this->handle, $width, $height);
        return $this;
    }

    public function redraw(): self {
        if ($this->handle) {
            Area::queueRedraw($this->handle);
        }
        return $this;
    }
    
    public function getHandle(): CData {
        return $this->handle;
    }

    private function getDrawCallback(): callable {
        $drawHandler = $this->drawHandler;
        return function($handler, $area, $params) use ($drawHandler) {
            if ($drawHandler) {
                $drawContext = new LibuiDrawContext($params);
                ($drawHandler)($drawContext);
            }
        };
    }

    private function getMouseCallback(): callable {
        $mouseHandler = $this->mouseHandler;
        return function($handler, $area, $mouseEvent) use ($mouseHandler) {
            if ($mouseHandler) {
                ($mouseHandler)($mouseEvent);
            }
        };
    }

    private function getKeyCallback(): callable {
        $keyHandler = $this->keyHandler;
        return function($handler, $area, $keyEvent) use ($keyHandler) {
            if ($keyHandler) {
                $result = ($keyHandler)($keyEvent);
                return $result ? 1 : 0;
            }
            return 0;
        };
    }

    /**
     * 新的回调处理方法，确保正确的参数传递
     */
    private function handleDrawCallback($handler, $area, $params): void {
        try {
            if ($this->drawHandler && $params) {
                // 确保参数有效
                if (isset($params->AreaWidth) && isset($params->AreaHeight) && isset($params->Context)) {
                    $drawContext = new LibuiDrawContext($params);
                    ($this->drawHandler)($drawContext);
                } else {
                    error_log("Invalid draw params structure");
                }
            }
        } catch (\Exception $e) {
            error_log("Draw callback exception: " . $e->getMessage());
        } catch (\Error $e) {
            error_log("Draw callback error: " . $e->getMessage());
        }
    }
    
    private function handleKeyCallback($handler, $area, $keyEvent): int {
        try {
            if ($this->keyHandler && $keyEvent) {
                $result = ($this->keyHandler)($keyEvent);
                return $result ? 1 : 0;
            }
        } catch (\Exception $e) {
            error_log("Key callback exception: " . $e->getMessage());
        } catch (\Error $e) {
            error_log("Key callback error: " . $e->getMessage());
        }
        return 0;
    }
    
    private function handleMouseCallback($handler, $area, $mouseEvent): void {
        try {
            if ($this->mouseHandler && $mouseEvent) {
                ($this->mouseHandler)($mouseEvent);
            }
        } catch (\Exception $e) {
            error_log("Mouse callback exception: " . $e->getMessage());
        } catch (\Error $e) {
            error_log("Mouse callback error: " . $e->getMessage());
        }
    }
    
    private function handleMouseCrossedCallback($handler, $area, $left): void {
        // 预留扩展
    }
    
    private function handleDragBrokenCallback($handler, $area): void {
        // 预留扩展
    }
}
