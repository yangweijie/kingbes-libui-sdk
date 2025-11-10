<?php

namespace UI;

/**
 * Represents dimensions (width, height)
 */
class Size
{
    /**
     * @var float The width
     */
    public float $width;

    /**
     * @var float The height
     */
    public float $height;

    /**
     * Construct a new Size
     *
     * @param float $width The width
     * @param float $height The height
     */
    public function __construct(float $width, float $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Retrieves Height
     *
     * @return float
     */
    public function getHeight(): float
    {
        return $this->height;
    }

    /**
     * Retrives Width
     *
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * Point Coercion
     *
     * @param Point $point The point to coerce
     * @return self
     */
    public static function of(Point $point): self
    {
        return new self($point->x, $point->y);
    }

    /**
     * Set Height
     *
     * @param float $height
     * @return void
     */
    public function setHeight(float $height): void
    {
        $this->height = $height;
    }

    /**
     * Set Width
     *
     * @param float $width
     * @return void
     */
    public function setWidth(float $width): void
    {
        $this->width = $width;
    }
}