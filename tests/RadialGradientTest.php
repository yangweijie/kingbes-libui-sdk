<?php

it('creates a radial gradient with correct coordinates', function () {
    $radialGradient = new UI\Draw\Brush\RadialGradient(50.0, 50.0, 75.0, 75.0, 50.0);
    expect($radialGradient->getType())->toBe(UI\Draw\Brush::TYPE_RADIAL_GRADIENT);
    expect($radialGradient->getX0())->toBe(50.0);
    expect($radialGradient->getY0())->toBe(50.0);
    expect($radialGradient->getX1())->toBe(75.0);
    expect($radialGradient->getY1())->toBe(75.0);
    expect($radialGradient->getOuterRadius())->toBe(50.0);
});