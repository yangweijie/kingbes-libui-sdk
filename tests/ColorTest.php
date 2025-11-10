<?php

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

it('sets color channels', function () {
    $color = new UI\Draw\Color(0.0, 0.0, 0.0, 0.0);
    $color->setR(1.0);
    $color->setG(0.5);
    $color->setB(0.25);
    $color->setA(1.0);
    expect($color->getR())->toBe(1.0);
    expect($color->getG())->toBe(0.5);
    expect($color->getB())->toBe(0.25);
    expect($color->getA())->toBe(1.0);
});

it('gets channels by index', function () {
    $color = new UI\Draw\Color(1.0, 0.5, 0.25, 1.0);
    expect($color->getChannel(0))->toBe(1.0);  // R
    expect($color->getChannel(1))->toBe(0.5);  // G
    expect($color->getChannel(2))->toBe(0.25); // B
    expect($color->getChannel(3))->toBe(1.0);  // A
});

it('throws exception for invalid channel', function () {
    $color = new UI\Draw\Color(0.0, 0.0, 0.0, 0.0);
    expect(fn() => $color->getChannel(4))->toThrow(\InvalidArgumentException::class);
});