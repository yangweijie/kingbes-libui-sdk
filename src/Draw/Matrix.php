<?php

namespace UI\Draw;

/**
 * Draw Matrix
 */
class Matrix
{
    /**
     * @var array The matrix values [a, b, c, d, tx, ty]
     */
    protected array $matrix;

    /**
     * Construct a new Matrix
     */
    public function __construct()
    {
        // Initialize to identity matrix
        $this->matrix = [1, 0, 0, 1, 0, 0];
    }

    /**
     * Invert Matrix
     *
     * @return bool True if the matrix was inverted, false otherwise
     */
    public function invert(): bool
    {
        // 简化的矩阵求逆实现
        $a = $this->matrix[0];
        $b = $this->matrix[1];
        $c = $this->matrix[2];
        $d = $this->matrix[3];
        $tx = $this->matrix[4];
        $ty = $this->matrix[5];
        
        $det = $a * $d - $b * $c;
        
        if ($det == 0) {
            return false;
        }
        
        $this->matrix = [
            $d / $det,
            -$b / $det,
            -$c / $det,
            $a / $det,
            ($c * $ty - $d * $tx) / $det,
            ($b * $tx - $a * $ty) / $det
        ];
        
        return true;
    }

    /**
     * Invertible Detection
     *
     * @return bool True if the matrix is invertible, false otherwise
     */
    public function isInvertible(): bool
    {
        $det = $this->matrix[0] * $this->matrix[3] - $this->matrix[1] * $this->matrix[2];
        return $det != 0;
    }

    /**
     * Multiply Matrix
     *
     * @param Matrix $src The source matrix
     * @return void
     */
    public function multiply(Matrix $src): void
    {
        $a1 = $this->matrix[0];
        $b1 = $this->matrix[1];
        $c1 = $this->matrix[2];
        $d1 = $this->matrix[3];
        $tx1 = $this->matrix[4];
        $ty1 = $this->matrix[5];
        
        $m2 = $src->getMatrix();
        $a2 = $m2[0];
        $b2 = $m2[1];
        $c2 = $m2[2];
        $d2 = $m2[3];
        $tx2 = $m2[4];
        $ty2 = $m2[5];
        
        $this->matrix = [
            $a1 * $a2 + $c1 * $b2,
            $b1 * $a2 + $d1 * $b2,
            $a1 * $c2 + $c1 * $d2,
            $b1 * $c2 + $d1 * $d2,
            $a1 * $tx2 + $c1 * $ty2 + $tx1,
            $b1 * $tx2 + $d1 * $ty2 + $ty1
        ];
    }

    /**
     * Rotate Matrix
     *
     * @param float $x The x-coordinate of the rotation center
     * @param float $y The y-coordinate of the rotation center
     * @param float $amount The rotation amount in radians
     * @return void
     */
    public function rotate(float $x, float $y, float $amount): void
    {
        // 先平移到原点，旋转，再平移回去
        $this->translate(-$x, -$y);
        
        $cos = cos($amount);
        $sin = sin($amount);
        
        $a = $this->matrix[0];
        $b = $this->matrix[1];
        $c = $this->matrix[2];
        $d = $this->matrix[3];
        $tx = $this->matrix[4];
        $ty = $this->matrix[5];
        
        $this->matrix = [
            $a * $cos - $b * $sin,
            $a * $sin + $b * $cos,
            $c * $cos - $d * $sin,
            $c * $sin + $d * $cos,
            $tx * $cos - $ty * $sin,
            $tx * $sin + $ty * $cos
        ];
        
        $this->translate($x, $y);
    }

    /**
     * Scale Matrix
     *
     * @param float $xCenter The x-coordinate of the scaling center
     * @param float $yCenter The y-coordinate of the scaling center
     * @param float $x The x-scale factor
     * @param float $y The y-scale factor
     * @return void
     */
    public function scale(float $xCenter, float $yCenter, float $x, float $y): void
    {
        // 先平移到原点，缩放，再平移回去
        $this->translate(-$xCenter, -$yCenter);
        
        $this->matrix[0] *= $x;
        $this->matrix[1] *= $x;
        $this->matrix[2] *= $y;
        $this->matrix[3] *= $y;
        
        $this->translate($xCenter, $yCenter);
    }

    /**
     * Skew Matrix
     *
     * @param float $x The x-coordinate of the skew point
     * @param float $y The y-coordinate of the skew point
     * @param float $xamount The x-skew amount in radians
     * @param float $yamount The y-skew amount in radians
     * @return void
     */
    public function skew(float $x, float $y, float $xamount, float $yamount): void
    {
        // 先平移到原点，倾斜，再平移回去
        $this->translate(-$x, -$y);
        
        $tanX = tan($xamount);
        $tanY = tan($yamount);
        
        $a = $this->matrix[0];
        $b = $this->matrix[1];
        $c = $this->matrix[2];
        $d = $this->matrix[3];
        $tx = $this->matrix[4];
        $ty = $this->matrix[5];
        
        $this->matrix = [
            $a + $c * $tanY,
            $b + $d * $tanY,
            $c + $a * $tanX,
            $d + $b * $tanX,
            $tx + $ty * $tanY,
            $ty + $tx * $tanX
        ];
        
        $this->translate($x, $y);
    }

    /**
     * Translate Matrix
     *
     * @param float $x The x-translation
     * @param float $y The y-translation
     * @return void
     */
    public function translate(float $x, float $y): void
    {
        $this->matrix[4] += $x;
        $this->matrix[5] += $y;
    }

    /**
     * Set Identity Matrix
     *
     * @return void
     */
    public function setIdentity(): void
    {
        $this->matrix = [1, 0, 0, 1, 0, 0];
    }

    /**
     * Get the matrix values
     *
     * @return array
     */
    public function getMatrix(): array
    {
        return $this->matrix;
    }
}