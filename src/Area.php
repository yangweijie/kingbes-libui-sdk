<?php

namespace UI;

use Kingbes\Libui\Area as LibuiArea;
use Kingbes\Libui\Control as LibuiControl;
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
        // Create the handler exactly like in the working test
        $handler = LibuiArea::handler(
            function ($h, $a, $params) use ($drawCallback) {
                if ($drawCallback) {
                    $drawCallback(new class {
                        public function __call($name, $arguments) {
                            return null;
                        }
                    });
                }
            },
            $keyCallback ? function ($h, $a, $keyEvent) use ($keyCallback) {
                $keyCallback($this, $keyEvent);
            } : null,
            $mouseCallback ? function ($h, $a, $mouseEvent) use ($mouseCallback) {
                $mouseCallback($this, $mouseEvent);
            } : null
        );

        // Create the area exactly like in the working test
        $this->area = LibuiArea::create($handler);
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