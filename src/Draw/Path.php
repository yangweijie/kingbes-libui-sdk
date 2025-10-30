<?php

namespace UI\Draw;

/**
 * Draw Path
 */
class Path
{
    /**
     * @var array The path commands
     */
    protected array $commands;

    /**
     * @var int The fill mode
     */
    protected int $fillMode;

    /**
     * Construct a new Path
     *
     * @param int $fillMode The fill mode (0 = Winding, 1 = Alternate)
     */
    public function __construct(int $fillMode = 0)
    {
        $this->fillMode = $fillMode;
        $this->commands = [];
    }

    /**
     * Draw a Rectangle
     *
     * @param float $x The x-coordinate
     * @param float $y The y-coordinate
     * @param float $width The width
     * @param float $height The height
     * @return void
     */
    public function addRectangle(float $x, float $y, float $width, float $height): void
    {
        $this->commands[] = ['type' => 'rectangle', 'x' => $x, 'y' => $y, 'width' => $width, 'height' => $height];
    }

    /**
     * Draw an Arc
     *
     * @param float $xCenter The x-coordinate of the center
     * @param float $yCenter The y-coordinate of the center
     * @param float $radius The radius
     * @param float $startAngle The start angle in radians
     * @param float $sweep The sweep angle in radians
     * @param bool $negative Whether the arc is negative
     * @return void
     */
    public function arcTo(float $xCenter, float $yCenter, float $radius, float $startAngle, float $sweep, bool $negative): void
    {
        $this->commands[] = [
            'type' => 'arc',
            'xCenter' => $xCenter,
            'yCenter' => $yCenter,
            'radius' => $radius,
            'startAngle' => $startAngle,
            'sweep' => $sweep,
            'negative' => $negative
        ];
    }

    /**
     * Draw Bezier Curve
     *
     * @param float $c1x The x-coordinate of the first control point
     * @param float $c1y The y-coordinate of the first control point
     * @param float $c2x The x-coordinate of the second control point
     * @param float $c2y The y-coordinate of the second control point
     * @param float $endX The x-coordinate of the end point
     * @param float $endY The y-coordinate of the end point
     * @return void
     */
    public function bezierTo(float $c1x, float $c1y, float $c2x, float $c2y, float $endX, float $endY): void
    {
        $this->commands[] = [
            'type' => 'bezier',
            'c1x' => $c1x,
            'c1y' => $c1y,
            'c2x' => $c2x,
            'c2y' => $c2y,
            'endX' => $endX,
            'endY' => $endY
        ];
    }

    /**
     * Close Figure
     *
     * @return void
     */
    public function closeFigure(): void
    {
        $this->commands[] = ['type' => 'close'];
    }

    /**
     * Finalize Path
     *
     * @return void
     */
    public function end(): void
    {
        $this->commands[] = ['type' => 'end'];
    }

    /**
     * Draw a Line
     *
     * @param float $x The x-coordinate
     * @param float $y The y-coordinate
     * @return void
     */
    public function lineTo(float $x, float $y): void
    {
        $this->commands[] = ['type' => 'line', 'x' => $x, 'y' => $y];
    }

    /**
     * Draw Figure
     *
     * @param float $x The x-coordinate
     * @param float $y The y-coordinate
     * @return void
     */
    public function newFigure(float $x, float $y): void
    {
        $this->commands[] = ['type' => 'figure', 'x' => $x, 'y' => $y];
    }

    /**
     * Draw Figure with Arc
     *
     * @param float $xCenter The x-coordinate of the center
     * @param float $yCenter The y-coordinate of the center
     * @param float $radius The radius
     * @param float $startAngle The start angle in radians
     * @param float $sweep The sweep angle in radians
     * @param bool $negative Whether the arc is negative
     * @return void
     */
    public function newFigureWithArc(float $xCenter, float $yCenter, float $radius, float $startAngle, float $sweep, bool $negative): void
    {
        $this->commands[] = [
            'type' => 'figureArc',
            'xCenter' => $xCenter,
            'yCenter' => $yCenter,
            'radius' => $radius,
            'startAngle' => $startAngle,
            'sweep' => $sweep,
            'negative' => $negative
        ];
    }

    /**
     * Get the path commands
     *
     * @return array
     */
    public function getCommands(): array
    {
        return $this->commands;
    }

    /**
     * Get the fill mode
     *
     * @return int
     */
    public function getFillMode(): int
    {
        return $this->fillMode;
    }
}