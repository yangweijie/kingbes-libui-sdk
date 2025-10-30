<?php

namespace UI\Draw\Brush;

/**
 * Radial Gradient
 */
class RadialGradient extends Gradient
{
    /**
     * Construct a new Radial Gradient
     *
     * @param float $startX The start x-coordinate
     * @param float $startY The start y-coordinate
     * @param float $outerX The outer circle center x-coordinate
     * @param float $outerY The outer circle center y-coordinate
     * @param float $outerRadius The outer circle radius
     */
    public function __construct(float $startX, float $startY, float $outerX, float $outerY, float $outerRadius)
    {
        parent::__construct(self::TYPE_RADIAL_GRADIENT);
        
        $this->x0 = $startX;
        $this->y0 = $startY;
        $this->x1 = $outerX;
        $this->y1 = $outerY;
        $this->outerRadius = $outerRadius;
    }
}