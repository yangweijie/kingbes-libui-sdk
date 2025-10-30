<?php

namespace UI\Draw\Text\Font;

/**
 * Font Descriptor
 * 
 * This class represents a font descriptor that can be used to describe
 * the properties of a font.
 */
class Descriptor
{
    /**
     * @var string The font family name
     */
    protected string $family;

    /**
     * @var float The font size
     */
    protected float $size;

    /**
     * @var int The font weight
     */
    protected int $weight;

    /**
     * @var int The font italic style
     */
    protected int $italic;

    /**
     * @var int The font stretch
     */
    protected int $stretch;

    /**
     * Construct a new Font Descriptor
     *
     * @param string $family The font family name
     * @param float $size The font size
     * @param int $weight The font weight
     * @param int $italic The font italic style
     * @param int $stretch The font stretch
     */
    public function __construct(
        string $family,
        float $size,
        int $weight,
        int $italic,
        int $stretch
    ) {
        $this->family = $family;
        $this->size = $size;
        $this->weight = $weight;
        $this->italic = $italic;
        $this->stretch = $stretch;
    }

    /**
     * Get the font family name
     *
     * @return string
     */
    public function getFamily(): string
    {
        return $this->family;
    }

    /**
     * Set the font family name
     *
     * @param string $family
     * @return void
     */
    public function setFamily(string $family): void
    {
        $this->family = $family;
    }

    /**
     * Get the font size
     *
     * @return float
     */
    public function getSize(): float
    {
        return $this->size;
    }

    /**
     * Set the font size
     *
     * @param float $size
     * @return void
     */
    public function setSize(float $size): void
    {
        $this->size = $size;
    }

    /**
     * Get the font weight
     *
     * @return int
     */
    public function getWeight(): int
    {
        return $this->weight;
    }

    /**
     * Set the font weight
     *
     * @param int $weight
     * @return void
     */
    public function setWeight(int $weight): void
    {
        $this->weight = $weight;
    }

    /**
     * Get the font italic style
     *
     * @return int
     */
    public function getItalic(): int
    {
        return $this->italic;
    }

    /**
     * Set the font italic style
     *
     * @param int $italic
     * @return void
     */
    public function setItalic(int $italic): void
    {
        $this->italic = $italic;
    }

    /**
     * Get the font stretch
     *
     * @return int
     */
    public function getStretch(): int
    {
        return $this->stretch;
    }

    /**
     * Set the font stretch
     *
     * @param int $stretch
     * @return void
     */
    public function setStretch(int $stretch): void
    {
        $this->stretch = $stretch;
    }
}