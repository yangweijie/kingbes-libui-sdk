<?php

namespace UI\Draw;

/**
 * Draw Stroke
 */
class Stroke
{
    /**
     * @var int The line cap style
     */
    protected int $cap;

    /**
     * @var int The line join style
     */
    protected int $join;

    /**
     * @var float The stroke thickness
     */
    protected float $thickness;

    /**
     * @var float The miter limit
     */
    protected float $miterLimit;

    /**
     * Construct a new Stroke
     *
     * @param int $cap The line cap style
     * @param int $join The line join style
     * @param float $thickness The stroke thickness
     * @param float $miterLimit The miter limit
     */
    public function __construct(
        int $cap = 0, // uiDrawLineCapFlat as default
        int $join = 0, // uiDrawLineJoinMiter as default
        float $thickness = 1.0,
        float $miterLimit = 10.0
    ) {
        $this->cap = $cap;
        $this->join = $join;
        $this->thickness = $thickness;
        $this->miterLimit = $miterLimit;
    }

    /**
     * Get Line Cap
     *
     * @return int The line cap style
     */
    public function getCap(): int
    {
        return $this->cap;
    }

    /**
     * Get Line Join
     *
     * @return int The line join style
     */
    public function getJoin(): int
    {
        return $this->join;
    }

    /**
     * Get Miter Limit
     *
     * @return float The miter limit
     */
    public function getMiterLimit(): float
    {
        return $this->miterLimit;
    }

    /**
     * Get Thickness
     *
     * @return float The stroke thickness
     */
    public function getThickness(): float
    {
        return $this->thickness;
    }

    /**
     * Set Line Cap
     *
     * @param int $cap The line cap style
     * @return void
     */
    public function setCap(int $cap): void
    {
        $this->cap = $cap;
    }

    /**
     * Set Line Join
     *
     * @param int $join The line join style
     * @return void
     */
    public function setJoin(int $join): void
    {
        $this->join = $join;
    }

    /**
     * Set Miter Limit
     *
     * @param float $miterLimit The miter limit
     * @return void
     */
    public function setMiterLimit(float $miterLimit): void
    {
        $this->miterLimit = $miterLimit;
    }

    /**
     * Set Thickness
     *
     * @param float $thickness The stroke thickness
     * @return void
     */
    public function setThickness(float $thickness): void
    {
        $this->thickness = $thickness;
    }

    /**
     * Get stroke parameters as an array
     *
     * @return array
     */
    public function getParams(): array
    {
        return [
            'cap' => $this->cap,
            'join' => $this->join,
            'thickness' => $this->thickness,
            'miterLimit' => $this->miterLimit
        ];
    }
}