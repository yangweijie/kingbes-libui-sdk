<?php

it('creates a linear gradient with correct coordinates', function () {
    $linearGradient = new UI\Draw\Brush\LinearGradient(0.0, 0.0, 100.0, 100.0);
    expect($linearGradient->getType())->toBe(UI\Draw\Brush::TYPE_LINEAR_GRADIENT);
    expect($linearGradient->getX0())->toBe(0.0);
    expect($linearGradient->getY0())->toBe(0.0);
    expect($linearGradient->getX1())->toBe(100.0);
    expect($linearGradient->getY1())->toBe(100.0);
});