<?php

namespace UI;

/**
 * Represents a position (x,y)
 */
class Point
{
    /**
     * @var float The x-coordinate
     */
    public float $x;

    /**
     * @var float The y-coordinate
     */
    public float $y;

    /**
     * Construct a new Point
     *
     * @param float $x The x-coordinate
     * @param float $y The y-coordinate
     */
    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * Size Coercion
     *
     * @param Size $size The size to coerce
     * @return self
     */
    public static function at(Size $size): self
    {
        return new self($size->width, $size->height);
    }

    /**
     * Retrieves X
     *
     * @return float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * Retrieves Y
     *
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * Set X
     *
     * @param float $x
     * @return void
     */
    public function setX(float $x): void
    {
        $this->x = $x;
    }

    /**
     * Set Y
     *
     * @param float $y
     * @return void
     */
    public function setY(float $y): void
    {
        $this->y = $y;
    }
}