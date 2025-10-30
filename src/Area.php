<?php

namespace UI;

use Kingbes\Libui\Area as LibuiArea;
use Kingbes\Libui\Control as LibuiControl;
use Kingbes\Libui\Draw;
use FFI\CData;

/**
 * Area
 */
class Area extends Control
{
    /**
     * @var CData The area handle
     */
    protected CData $area;

    /**
     * @var object The area handler
     */
    protected object $areaHandler;

    /**
     * Construct a new Area
     *
     * @param callable|null $drawCallback Draw callback
     * @param callable|null $mouseCallback Mouse callback
     * @param callable|null $keyCallback Key callback
     */
    public function __construct(
        ?callable $drawCallback = null,
        ?callable $mouseCallback = null,
        ?callable $keyCallback = null
    ) {
        // Create a handler object
        $this->areaHandler = new class {
            public $drawCallback;
            public $mouseCallback;
            public $keyCallback;
        };
        
        $this->areaHandler->drawCallback = $drawCallback;
        $this->areaHandler->mouseCallback = $mouseCallback;
        $this->areaHandler->keyCallback = $keyCallback;
        
        // Create the libui area handler
        $handler = LibuiArea::handler(
            function ($h, $a, $params) {
                $this->handleDraw($params);
            },
            function ($h, $a, $keyEvent) {
                $this->handleKey($keyEvent);
            },
            function ($h, $a, $mouseEvent) {
                $this->handleMouse($mouseEvent);
            }
        );
        
        // Create the area
        $this->area = LibuiArea::create($handler);
    }

    /**
     * Handle draw event
     *
     * @param CData $params Draw parameters
     * @return void
     */
    protected function handleDraw(CData $params): void
    {
        if ($this->areaHandler->drawCallback) {
            // Create a DrawParams object from the CData
            $drawParams = new Area\DrawParams(
                $params->AreaWidth,
                $params->AreaHeight,
                $params->ClipX,
                $params->ClipY,
                $params->ClipWidth,
                $params->ClipHeight
            );
            
            // Call the draw callback
            ($this->areaHandler->drawCallback)($drawParams);
        }
    }

    /**
     * Handle key event
     *
     * @param CData $keyEvent Key event data
     * @return void
     */
    protected function handleKey(CData $keyEvent): void
    {
        if ($this->areaHandler->keyCallback) {
            // Call the key callback
            ($this->areaHandler->keyCallback)($keyEvent);
        }
    }

    /**
     * Handle mouse event
     *
     * @param CData $mouseEvent Mouse event data
     * @return void
     */
    protected function handleMouse(CData $mouseEvent): void
    {
        if ($this->areaHandler->mouseCallback) {
            // Call the mouse callback
            ($this->areaHandler->mouseCallback)($mouseEvent);
        }
    }

    /**
     * Draw Callback
     *
     * @param callable $callback Callback function
     * @return void
     */
    public function onDraw(callable $callback): void
    {
        $this->areaHandler->drawCallback = $callback;
    }

    /**
     * Key Callback
     *
     * @param callable $callback Callback function
     * @return void
     */
    public function onKey(callable $callback): void
    {
        $this->areaHandler->keyCallback = $callback;
    }

    /**
     * Mouse Callback
     *
     * @param callable $callback Callback function
     * @return void
     */
    public function onMouse(callable $callback): void
    {
        $this->areaHandler->mouseCallback = $callback;
    }

    /**
     * Get the area handler
     *
     * @return object
     */
    public function getHandler(): object
    {
        return $this->areaHandler;
    }

    /**
     * Get the underlying FFI area handle (for internal use)
     *
     * @return CData
     */
    public function getHandle(): CData
    {
        return $this->area;
    }

    /**
     * Set the size of the area
     *
     * @param Size $size The size to set
     * @return void
     */
    public function setSize(Size $size): void
    {
        LibuiArea::setSize($this->area, (int)$size->width, (int)$size->height);
    }

    /**
     * Queue a redraw of the entire area
     *
     * @return void
     */
    public function queueRedraw(): void
    {
        LibuiArea::queueRedraw($this->area);
    }

    /**
     * 显示控件
     *
     * @return void
     */
    public function show(): void
    {
        LibuiControl::show($this->area);
    }

    /**
     * 隐藏控件
     *
     * @return void
     */
    public function hide(): void
    {
        LibuiControl::hide($this->area);
    }
}