<?php

namespace UI\Draw\Brush;

/**
 * Linear Gradient
 */
class LinearGradient extends Gradient
{
    /**
     * Construct a Linear Gradient
     *
     * @param float $startX The start x-coordinate
     * @param float $startY The start y-coordinate
     * @param float $endX The end x-coordinate
     * @param float $endY The end y-coordinate
     */
    public function __construct(float $startX, float $startY, float $endX, float $endY)
    {
        parent::__construct(self::TYPE_LINEAR_GRADIENT);
        
        $this->x0 = $startX;
        $this->y0 = $startY;
        $this->x1 = $endX;
        $this->y1 = $endY;
    }
}