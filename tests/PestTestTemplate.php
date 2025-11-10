<?php

// PointTest.php
it('creates a point with correct coordinates', function () {
    $point = new UI\Point(10.0, 20.0);
    expect($point->getX())->toBe(10.0);
    expect($point->getY())->toBe(20.0);
});

it('sets point coordinates', function () {
    $point = new UI\Point(0.0, 0.0);
    $point->setX(15.0);
    $point->setY(25.0);
    expect($point->getX())->toBe(15.0);
    expect($point->getY())->toBe(25.0);
});

// SizeTest.php
it('creates a size with correct dimensions', function () {
    $size = new UI\Size(100.0, 200.0);
    expect($size->getWidth())->toBe(100.0);
    expect($size->getHeight())->toBe(200.0);
});

it('sets size dimensions', function () {
    $size = new UI\Size(0.0, 0.0);
    $size->setWidth(150.0);
    $size->setHeight(250.0);
    expect($size->getWidth())->toBe(150.0);
    expect($size->getHeight())->toBe(250.0);
});

// ColorTest.php
it('creates a color with correct values', function () {
    $color = new UI\Draw\Color(1.0, 0.5, 0.25, 1.0);
    expect($color->getR())->toBe(1.0);
    expect($color->getG())->toBe(0.5);
    expect($color->getB())->toBe(0.25);
    expect($color->getA())->toBe(1.0);
});

it('clamps color values', function () {
    $color = new UI\Draw\Color(1.5, -0.5, 0.0, 0.0);
    expect($color->getR())->toBe(1.0);  // Clamped to 1.0
    expect($color->getG())->toBe(0.0);  // Clamped to 0.0
});

// BrushTest.php
it('creates a brush with correct type', function () {
    $brush = new UI\Draw\Brush();
    expect($brush->getType())->toBe(UI\Draw\Brush::TYPE_SOLID);
});

// GradientTest.php
it('creates a gradient with correct type', function () {
    $gradient = new UI\Draw\Brush\Gradient(UI\Draw\Brush::TYPE_LINEAR_GRADIENT);
    expect($gradient->getType())->toBe(UI\Draw\Brush::TYPE_LINEAR_GRADIENT);
});

// LinearGradientTest.php
it('creates a linear gradient with correct coordinates', function () {
    $linearGradient = new UI\Draw\Brush\LinearGradient(0.0, 0.0, 100.0, 100.0);
    expect($linearGradient->getType())->toBe(UI\Draw\Brush::TYPE_LINEAR_GRADIENT);
    expect($linearGradient->getX0())->toBe(0.0);
    expect($linearGradient->getY0())->toBe(0.0);
    expect($linearGradient->getX1())->toBe(100.0);
    expect($linearGradient->getY1())->toBe(100.0);
});

// RadialGradientTest.php
it('creates a radial gradient with correct coordinates', function () {
    $radialGradient = new UI\Draw\Brush\RadialGradient(50.0, 50.0, 75.0, 75.0, 50.0);
    expect($radialGradient->getType())->toBe(UI\Draw\Brush::TYPE_RADIAL_GRADIENT);
    expect($radialGradient->getX0())->toBe(50.0);
    expect($radialGradient->getY0())->toBe(50.0);
    expect($radialGradient->getX1())->toBe(75.0);
    expect($radialGradient->getY1())->toBe(75.0);
    expect($radialGradient->getOuterRadius())->toBe(50.0);
});

// FontTest.php
it('creates a font with correct properties', function () {
    $font = new UI\Draw\Text\Font("Arial", 12.0, UI\Draw\Text\Font\Weight::NORMAL, UI\Draw\Text\Font\Italic::NORMAL, UI\Draw\Text\Font\Stretch::NORMAL);
    expect($font->getFamily())->toBe("Arial");
    expect($font->getSize())->toBe(12.0);
    expect($font->getWeight())->toBe(UI\Draw\Text\Font\Weight::NORMAL);
    expect($font->getItalic())->toBe(UI\Draw\Text\Font\Italic::NORMAL);
    expect($font->getStretch())->toBe(UI\Draw\Text\Font\Stretch::NORMAL);
});

// LayoutTest.php
it('creates a layout with correct properties', function () {
    $font = new UI\Draw\Text\Font("Arial", 12.0, UI\Draw\Text\Font\Weight::NORMAL, UI\Draw\Text\Font\Italic::NORMAL, UI\Draw\Text\Font\Stretch::NORMAL);
    $layout = new UI\Draw\Text\Layout("Hello World", $font, 100.0, UI\Draw\Text\Align::LEFT);
    expect($layout->getText())->toBe("Hello World");
    expect($layout->getFont())->toBe($font);
    expect($layout->getWidth())->toBe(100.0);
    expect($layout->getAlign())->toBe(UI\Draw\Text\Align::LEFT);
});

// ExceptionTest.php
it('throws invalid argument exception', function () {
    expect(fn() => throw new UI\Exception\InvalidArgumentException("Test exception"))->toThrow(UI\Exception\InvalidArgumentException::class);
});

it('throws runtime exception', function () {
    expect(fn() => throw new UI\Exception\RuntimeException("Test exception"))->toThrow(UI\Exception\RuntimeException::class);
});