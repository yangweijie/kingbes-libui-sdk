<?php

namespace UI\Draw;

use UI\Point;

/**
 * Draw Pen
 */
class Pen
{
    /**
     * Draw Text at Point
     *
     * @param string $text The text to draw
     * @param Point $point The point to draw at
     * @param Text\Font $font The font to use
     * @param Color $color The color to use
     * @return void
     */
    public function write(string $text, Point $point, Text\Font $font, Color $color): void
    {
        // This is a simplified implementation.
        // In a real implementation, you would need to create a uiDrawTextLayout
        // and use uiDrawText to render it.
        // This requires a more complex setup with uiAttributedString and uiDrawTextLayoutParams.
    }
}