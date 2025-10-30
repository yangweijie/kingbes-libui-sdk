<?php

namespace UI\Draw;

/**
 * Color Representation
 */
class Color
{
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
     * Construct new Color
     *
     * @param float $r The red component (0.0 to 1.0)
     * @param float $g The green component (0.0 to 1.0)
     * @param float $b The blue component (0.0 to 1.0)
     * @param float $a The alpha component (0.0 to 1.0)
     */
    public function __construct(float $r, float $g, float $b, float $a = 1.0)
    {
        $this->r = $this->clamp($r);
        $this->g = $this->clamp($g);
        $this->b = $this->clamp($b);
        $this->a = $this->clamp($a);
    }

    /**
     * Color Manipulation
     *
     * @param int $channel The channel to get (0=R, 1=G, 2=B, 3=A)
     * @return float The channel value
     */
    public function getChannel(int $channel): float
    {
        switch ($channel) {
            case 0:
                return $this->r;
            case 1:
                return $this->g;
            case 2:
                return $this->b;
            case 3:
                return $this->a;
            default:
                throw new \InvalidArgumentException("Invalid channel: $channel");
        }
    }

    /**
     * Color Manipulation
     *
     * @param int $channel The channel to set (0=R, 1=G, 2=B, 3=A)
     * @param float $value The value to set (0.0 to 1.0)
     * @return void
     */
    public function setChannel(int $channel, float $value): void
    {
        $clampedValue = $this->clamp($value);
        switch ($channel) {
            case 0:
                $this->r = $clampedValue;
                break;
            case 1:
                $this->g = $clampedValue;
                break;
            case 2:
                $this->b = $clampedValue;
                break;
            case 3:
                $this->a = $clampedValue;
                break;
            default:
                throw new \InvalidArgumentException("Invalid channel: $channel");
        }
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
     * Get the green component
     *
     * @return float
     */
    public function getG(): float
    {
        return $this->g;
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
     * Get the alpha component
     *
     * @return float
     */
    public function getA(): float
    {
        return $this->a;
    }

    /**
     * Set the red component
     *
     * @param float $r The red component (0.0 to 1.0)
     * @return void
     */
    public function setR(float $r): void
    {
        $this->r = $this->clamp($r);
    }

    /**
     * Set the green component
     *
     * @param float $g The green component (0.0 to 1.0)
     * @return void
     */
    public function setG(float $g): void
    {
        $this->g = $this->clamp($g);
    }

    /**
     * Set the blue component
     *
     * @param float $b The blue component (0.0 to 1.0)
     * @return void
     */
    public function setB(float $b): void
    {
        $this->b = $this->clamp($b);
    }

    /**
     * Set the alpha component
     *
     * @param float $a The alpha component (0.0 to 1.0)
     * @return void
     */
    public function setA(float $a): void
    {
        $this->a = $this->clamp($a);
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