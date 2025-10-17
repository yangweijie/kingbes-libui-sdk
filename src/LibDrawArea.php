<?php

// 最终稳定版本的 LibDrawArea
namespace Kingbes\Libui\SDK;

use FFI\CData;
use Kingbes\Libui\Area;
use Kingbes\Libui\Draw;
use Kingbes\Libui\DrawBrushType;
use Kingbes\Libui\DrawFillMode;

/**
 * LibDrawArea 抽象类 - 基于 main2.php 成功模式的极简封装
 * 
 * 提供标准化的绘图区域封装，子类只需实现具体的绘图逻辑
 * 完全遵循 main2_final.php 的成功模式，去除复杂封装
 * 
 * 设计特点：
 * - 模板方法模式：子类只需实现 draw() 和 onMouseClick()
 * - 内置错误处理：所有 FFI 回调都有异常捕获
 * - 标准化接口：统一的绘图上下文和事件处理
 * - 长方形画网格线、棋盘背景色（支持你的需求）
 */
abstract class LibDrawArea
{
    protected $handler;
    protected $drawCallback;
    protected $mouseCallback;
    protected $keyCallback;
    protected $handle;
    
    protected int $width = 400;
    protected int $height = 400;

    public function __construct(int $width = 400, int $height = 400) {
        $this->width = $width;
        $this->height = $height;
        $this->createHandler();
    }

    /**
     * 创建处理程序 - 模仿 main2_final.php 的成功模式
     */
    protected function createHandler(): void {
        // 保存回调引用，防止垃圾回收
        $this->drawCallback = [$this, 'handleDraw'];
        $this->mouseCallback = [$this, 'handleMouse'];
        $this->keyCallback = [$this, 'handleKey'];
        
        // 创建处理程序 - 完全模仿 main2_final.php 的成功模式
        $this->handler = Area::handler(
            $this->drawCallback,
            $this->keyCallback,
            $this->mouseCallback,
            [$this, 'handleMouseCrossed'],
            [$this, 'handleDragBroken']
        );
        
        // 创建区域 - 模仿 main2_final.php 的成功模式
        $this->handle = Area::create($this->handler);
    }

    /**
     * 绘图回调处理 - 模板方法模式
     */
    public function handleDraw($handler, $area, $params): void {
        try {
            // 调用抽象绘图方法
            $this->draw($params);
        } catch (\Exception $e) {
            $this->handleDrawError($e);
        } catch (\Error $e) {
            $this->handleDrawError($e);
        }
    }

    /**
     * 鼠标事件处理 - 模板方法模式
     */
    public function handleMouse($handler, $area, $mouseEvent): void {
        try {
            // 只处理鼠标按下事件
            if ($mouseEvent->Down === 1) {
                $x = $mouseEvent->X;
                $y = $mouseEvent->Y;
                
                // 调用抽象鼠标处理方法
                $this->onMouseClick($x, $y, $mouseEvent);
                
                // 触发重绘
                $this->redraw();
            }
        } catch (\Exception $e) {
            $this->handleMouseError($e);
        } catch (\Error $e) {
            $this->handleMouseError($e);
        }
    }

    /**
     * 键盘事件处理
     */
    public function handleKey($handler, $area, $keyEvent): int {
        try {
            return $this->onKeyPress($keyEvent) ? 1 : 0;
        } catch (\Exception $e) {
            $this->handleKeyError($e);
            return 0;
        } catch (\Error $e) {
            $this->handleKeyError($e);
            return 0;
        }
    }

    /**
     * 鼠标跨域事件处理
     */
    public function handleMouseCrossed($handler, $area, $left): void {
        try {
            $this->onMouseCrossed($left);
        } catch (\Exception $e) {
            $this->handleMouseCrossedError($e);
        } catch (\Error $e) {
            $this->handleMouseCrossedError($e);
        }
    }

    /**
     * 拖动中断事件处理
     */
    public function handleDragBroken($handler, $area): void {
        try {
            $this->onDragBroken();
        } catch (\Exception $e) {
            $this->handleDragBrokenError($e);
        } catch (\Error $e) {
            $this->handleDragBrokenError($e);
        }
    }

    /**
     * 抽象方法：绘图逻辑 - 子类必须实现
     * 
     * @param CData $params 原始绘图参数
     */
    abstract protected function draw(CData $params): void;

    /**
     * 抽象方法：鼠标点击处理 - 子类必须实现
     * 
     * @param float $x X坐标
     * @param float $y Y坐标  
     * @param CData $mouseEvent 原始鼠标事件
     */
    abstract protected function onMouseClick(float $x, float $y, CData $mouseEvent): void;

    /**
     * 钩子方法：键盘事件处理 - 子类可选择实现
     * 
     * @param CData $keyEvent 键盘事件
     * @return bool 是否处理了事件
     */
    protected function onKeyPress(CData $keyEvent): bool {
        return false;
    }

    /**
     * 钩子方法：鼠标跨域事件 - 子类可选择实现
     * 
     * @param bool $left 是否离开区域
     */
    protected function onMouseCrossed(bool $left): void {
        // 默认空实现
    }

    /**
     * 钩子方法：拖动中断事件 - 子类可选择实现
     */
    protected function onDragBroken(): void {
        // 默认空实现
    }

    /**
     * 获取区域句柄
     */
    public function getHandle() {
        return $this->handle;
    }

    /**
     * 设置区域尺寸
     */
    public function setSize(int $width, int $height): self {
        $this->width = $width;
        $this->height = $height;
        // 注意：不要在非滚动区域上调用 Area::setSize()，否则会报错
        return $this;
    }

    /**
     * 触发重绘
     */
    public function redraw(): self {
        if ($this->handle) {
            Area::queueRedraw($this->handle);
        }
        return $this;
    }

    /**
     * 获取区域尺寸
     */
    public function getWidth(): int {
        return $this->width;
    }

    public function getHeight(): int {
        return $this->height;
    }

    /**
     * 错误处理方法 - 可被子类重写
     */
    protected function handleDrawError(\Throwable $error): void {
        error_log("LibDrawArea draw error: " . $error->getMessage());
    }

    protected function handleMouseError(\Throwable $error): void {
        error_log("LibDrawArea mouse error: " . $error->getMessage());
    }

    protected function handleKeyError(\Throwable $error): void {
        error_log("LibDrawArea key error: " . $error->getMessage());
    }

    protected function handleMouseCrossedError(\Throwable $error): void {
        error_log("LibDrawArea mouse crossed error: " . $error->getMessage());
    }

    protected function handleDragBrokenError(\Throwable $error): void {
        error_log("LibDrawArea drag broken error: " . $error->getMessage());
    }
}