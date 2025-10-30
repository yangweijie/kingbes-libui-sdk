<?php

namespace UI\Draw\Text;

/**
 * Represents Text Layout
 * 
 * This class represents a text layout object that can be used to draw text
 * with specific formatting and layout properties.
 */
class Layout
{
    /**
     * @var string The text content
     */
    protected string $text;

    /**
     * @var ?Font The font to use for this layout
     */
    protected ?Font $font;

    /**
     * @var float The width of the layout
     */
    protected float $width;

    /**
     * @var int The text alignment
     */
    protected int $align;

    /**
     * Construct a new Text Layout
     *
     * @param string $text The text content
     * @param Font $font The font to use
     * @param float $width The width of the layout
     * @param int $align The text alignment (default: Align::LEFT)
     */
    public function __construct(string $text, Font $font, float $width, int $align = 0)
    {
        $this->text = $text;
        $this->font = $font;
        $this->width = $width;
        $this->align = $align;
    }

    /**
     * Get the text content
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Set the text content
     *
     * @param string $text
     * @return void
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * Get the font
     *
     * @return Font|null
     */
    public function getFont(): ?Font
    {
        return $this->font;
    }

    /**
     * Set the font
     *
     * @param Font $font
     * @return void
     */
    public function setFont(Font $font): void
    {
        $this->font = $font;
    }

    /**
     * Get the width
     *
     * @return float
     */
    public function getWidth(): float
    {
        return $this->width;
    }

    /**
     * Set the width
     *
     * @param float $width
     * @return void
     */
    public function setWidth(float $width): void
    {
        $this->width = $width;
    }

    /**
     * Get the alignment
     *
     * @return int
     */
    public function getAlign(): int
    {
        return $this->align;
    }

    /**
     * Set the alignment
     *
     * @param int $align
     * @return void
     */
    public function setAlign(int $align): void
    {
        $this->align = $align;
    }
}