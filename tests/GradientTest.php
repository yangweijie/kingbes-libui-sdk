<?php

it('creates a gradient with correct type', function () {
    $gradient = new UI\Draw\Brush\Gradient(UI\Draw\Brush::TYPE_LINEAR_GRADIENT);
    expect($gradient->getType())->toBe(UI\Draw\Brush::TYPE_LINEAR_GRADIENT);
});

it('throws exception for invalid gradient type', function () {
    expect(fn() => new UI\Draw\Brush\Gradient(999))->toThrow(\InvalidArgumentException::class);
});

it('adds gradient stops', function () {
    $gradient = new UI\Draw\Brush\Gradient(UI\Draw\Brush::TYPE_LINEAR_GRADIENT);
    $gradient->addStop(0.0, 1.0, 0.0, 0.0, 1.0);  // Red at start
    $gradient->addStop(1.0, 0.0, 0.0, 1.0, 1.0);  // Blue at end
    expect($gradient->getNumStops())->toBe(2);
});

it('gets gradient stop', function () {
    $gradient = new UI\Draw\Brush\Gradient(UI\Draw\Brush::TYPE_LINEAR_GRADIENT);
    $gradient->addStop(0.0, 1.0, 0.0, 0.0, 1.0);  // Red at start
    $stop = $gradient->getStop(0);
    expect($stop['pos'])->toBe(0.0);
    expect($stop['r'])->toBe(1.0);
    expect($stop['g'])->toBe(0.0);
    expect($stop['b'])->toBe(0.0);
    expect($stop['a'])->toBe(1.0);
});

it('sets gradient stop', function () {
    $gradient = new UI\Draw\Brush\Gradient(UI\Draw\Brush::TYPE_LINEAR_GRADIENT);
    $gradient->addStop(0.0, 1.0, 0.0, 0.0, 1.0);
    $gradient->setStop(0, 0.5, 0.0, 1.0, 0.0, 1.0);  // Change to green at middle
    $stop = $gradient->getStop(0);
    expect($stop['pos'])->toBe(0.5);
    expect($stop['r'])->toBe(0.0);
    expect($stop['g'])->toBe(1.0);
    expect($stop['b'])->toBe(0.0);
    expect($stop['a'])->toBe(1.0);
});

it('deletes gradient stop', function () {
    $gradient = new UI\Draw\Brush\Gradient(UI\Draw\Brush::TYPE_LINEAR_GRADIENT);
    $gradient->addStop(0.0, 1.0, 0.0, 0.0, 1.0);
    $gradient->addStop(1.0, 0.0, 0.0, 1.0, 1.0);
    expect($gradient->getNumStops())->toBe(2);
    $gradient->delStop(0);
    expect($gradient->getNumStops())->toBe(1);
});

it('throws exception for invalid stop index', function () {
    $gradient = new UI\Draw\Brush\Gradient(UI\Draw\Brush::TYPE_LINEAR_GRADIENT);
    expect(fn() => $gradient->getStop(0))->toThrow(\InvalidArgumentException::class);  // No stops yet
});