<?php

namespace UI\Draw;

/**
 * Brushes
 */
class Brush
{
    // Brush types
    const TYPE_SOLID = 0;
    const TYPE_LINEAR_GRADIENT = 1;
    const TYPE_RADIAL_GRADIENT = 2;
    const TYPE_IMAGE = 3;
    
    /**
     * @var int The brush type
     */
    protected int $type;
    
    /**
     * @var float The red component (0.0 to 1.0)
     */
    protected float $r;
    
    /**
     * @var float The green component (0.0 to 1.0)
     */
    protected float $g;
    
    /**
     * @var float The blue component (0.0 to 1.0)
     */
    protected float $b;
    
    /**
     * @var float The alpha component (0.0 to 1.0)
     */
    protected float $a;
    
    /**
     * @var float X coordinate for gradient start
     */
    protected float $x0;
    
    /**
     * @var float Y coordinate for gradient start
     */
    protected float $y0;
    
    /**
     * @var float X coordinate for gradient end
     */
    protected float $x1;
    
    /**
     * @var float Y coordinate for gradient end
     */
    protected float $y1;
    
    /**
     * @var float Outer radius for radial gradient
     */
    protected float $outerRadius;

    /**
     * Construct a new Brush
     *
     * @param int $type The brush type
     */
    public function __construct(int $type = 0) // TYPE_SOLID as default
    {
        $this->type = $type;
        
        // Initialize solid brush color to black
        if ($type == self::TYPE_SOLID) {
            $this->r = 0.0;
            $this->g = 0.0;
            $this->b = 0.0;
            $this->a = 1.0;
        }
        
        // Initialize gradient coordinates to zero
        $this->x0 = 0.0;
        $this->y0 = 0.0;
        $this->x1 = 0.0;
        $this->y1 = 0.0;
        $this->outerRadius = 0.0;
    }

    /**
     * Get the brush type
     *
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * Set the brush type
     *
     * @param int $type
     * @return void
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }

    /**
     * Get the red component
     *
     * @return float
     */
    public function getR(): float
    {
        return $this->r;
    }

    /**
     * Set the red component
     *
     * @param float $r
     * @return void
     */
    public function setR(float $r): void
    {
        $this->r = $this->clamp($r);
    }

    /**
     * Get the green component
     *
     * @return float
     */
    public function getG(): float
    {
        return $this->g;
    }

    /**
     * Set the green component
     *
     * @param float $g
     * @return void
     */
    public function setG(float $g): void
    {
        $this->g = $this->clamp($g);
    }

    /**
     * Get the blue component
     *
     * @return float
     */
    public function getB(): float
    {
        return $this->b;
    }

    /**
     * Set the blue component
     *
     * @param float $b
     * @return void
     */
    public function setB(float $b): void
    {
        $this->b = $this->clamp($b);
    }

    /**
     * Get the alpha component
     *
     * @return float
     */
    public function getA(): float
    {
        return $this->a;
    }

    /**
     * Set the alpha component
     *
     * @param float $a
     * @return void
     */
    public function setA(float $a): void
    {
        $this->a = $this->clamp($a);
    }

    /**
     * Get X coordinate for gradient start
     *
     * @return float
     */
    public function getX0(): float
    {
        return $this->x0;
    }

    /**
     * Set X coordinate for gradient start
     *
     * @param float $x0
     * @return void
     */
    public function setX0(float $x0): void
    {
        $this->x0 = $x0;
    }

    /**
     * Get Y coordinate for gradient start
     *
     * @return float
     */
    public function getY0(): float
    {
        return $this->y0;
    }

    /**
     * Set Y coordinate for gradient start
     *
     * @param float $y0
     * @return void
     */
    public function setY0(float $y0): void
    {
        $this->y0 = $y0;
    }

    /**
     * Get X coordinate for gradient end
     *
     * @return float
     */
    public function getX1(): float
    {
        return $this->x1;
    }

    /**
     * Set X coordinate for gradient end
     *
     * @param float $x1
     * @return void
     */
    public function setX1(float $x1): void
    {
        $this->x1 = $x1;
    }

    /**
     * Get Y coordinate for gradient end
     *
     * @return float
     */
    public function getY1(): float
    {
        return $this->y1;
    }

    /**
     * Set Y coordinate for gradient end
     *
     * @param float $y1
     * @return void
     */
    public function setY1(float $y1): void
    {
        $this->y1 = $y1;
    }

    /**
     * Get outer radius for radial gradient
     *
     * @return float
     */
    public function getOuterRadius(): float
    {
        return $this->outerRadius;
    }

    /**
     * Set outer radius for radial gradient
     *
     * @param float $outerRadius
     * @return void
     */
    public function setOuterRadius(float $outerRadius): void
    {
        $this->outerRadius = $outerRadius;
    }

    /**
     * Clamp a value between 0.0 and 1.0
     *
     * @param float $value The value to clamp
     * @return float The clamped value
     */
    protected function clamp(float $value): float
    {
        return max(0.0, min(1.0, $value));
    }
}