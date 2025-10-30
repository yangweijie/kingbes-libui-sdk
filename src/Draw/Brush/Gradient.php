<?php

namespace UI\Draw\Brush;

use UI\Draw\Brush;

/**
 * Gradient Brushes
 */
class Gradient extends Brush
{
    /**
     * @var array Gradient stops
     */
    protected array $stops;

    /**
     * Construct a new Gradient Brush
     *
     * @param int $type The brush type (TYPE_LINEAR_GRADIENT or TYPE_RADIAL_GRADIENT)
     */
    public function __construct(int $type)
    {
        parent::__construct($type);
        
        if ($type != self::TYPE_LINEAR_GRADIENT && $type != self::TYPE_RADIAL_GRADIENT) {
            throw new \InvalidArgumentException("Gradient brush type must be TYPE_LINEAR_GRADIENT (1) or TYPE_RADIAL_GRADIENT (2)");
        }
        
        // Initialize gradient properties
        $this->x0 = 0.0;
        $this->y0 = 0.0;
        $this->x1 = 0.0;
        $this->y1 = 0.0;
        $this->outerRadius = 0.0;
        $this->stops = [];
    }

    /**
     * Add a gradient stop
     *
     * @param float $pos The stop position (0.0 to 1.0)
     * @param float $r The red component (0.0 to 1.0)
     * @param float $g The green component (0.0 to 1.0)
     * @param float $b The blue component (0.0 to 1.0)
     * @param float $a The alpha component (0.0 to 1.0)
     * @return void
     */
    public function addStop(float $pos, float $r, float $g, float $b, float $a): void
    {
        $this->stops[] = [
            'pos' => $this->clamp($pos),
            'r' => $this->clamp($r),
            'g' => $this->clamp($g),
            'b' => $this->clamp($b),
            'a' => $this->clamp($a)
        ];
    }

    /**
     * Delete a gradient stop
     *
     * @param int $index The stop index
     * @return void
     */
    public function delStop(int $index): void
    {
        if ($index < 0 || $index >= count($this->stops)) {
            throw new \InvalidArgumentException("Stop index out of range");
        }
        
        array_splice($this->stops, $index, 1);
    }

    /**
     * Set a gradient stop
     *
     * @param int $index The stop index
     * @param float $pos The stop position (0.0 to 1.0)
     * @param float $r The red component (0.0 to 1.0)
     * @param float $g The green component (0.0 to 1.0)
     * @param float $b The blue component (0.0 to 1.0)
     * @param float $a The alpha component (0.0 to 1.0)
     * @return void
     */
    public function setStop(int $index, float $pos, float $r, float $g, float $b, float $a): void
    {
        if ($index < 0 || $index >= count($this->stops)) {
            throw new \InvalidArgumentException("Stop index out of range");
        }
        
        $this->stops[$index] = [
            'pos' => $this->clamp($pos),
            'r' => $this->clamp($r),
            'g' => $this->clamp($g),
            'b' => $this->clamp($b),
            'a' => $this->clamp($a)
        ];
    }
    
    /**
     * Get a gradient stop
     *
     * @param int $index The stop index
     * @return array{pos: float, r: float, g: float, b: float, a: float} The stop data
     */
    public function getStop(int $index): array
    {
        if ($index < 0 || $index >= count($this->stops)) {
            throw new \InvalidArgumentException("Stop index out of range");
        }
        
        return $this->stops[$index];
    }
    
    /**
     * Get the number of gradient stops
     *
     * @return int The number of stops
     */
    public function getNumStops(): int
    {
        return count($this->stops);
    }
}