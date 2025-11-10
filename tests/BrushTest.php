<?php

it('creates a brush with correct type', function () {
    $brush = new UI\Draw\Brush();
    expect($brush->getType())->toBe(UI\Draw\Brush::TYPE_SOLID);
});

it('sets brush type', function () {
    $brush = new UI\Draw\Brush();
    $brush->setType(UI\Draw\Brush::TYPE_LINEAR_GRADIENT);
    expect($brush->getType())->toBe(UI\Draw\Brush::TYPE_LINEAR_GRADIENT);
});

it('sets brush color values', function () {
    $brush = new UI\Draw\Brush();
    $brush->setR(1.0);
    $brush->setG(0.5);
    $brush->setB(0.25);
    $brush->setA(1.0);
    expect($brush->getR())->toBe(1.0);
    expect($brush->getG())->toBe(0.5);
    expect($brush->getB())->toBe(0.25);
    expect($brush->getA())->toBe(1.0);
});

it('sets gradient coordinates', function () {
    $brush = new UI\Draw\Brush();
    $brush->setX0(10.0);
    $brush->setY0(20.0);
    $brush->setX1(30.0);
    $brush->setY1(40.0);
    $brush->setOuterRadius(50.0);
    expect($brush->getX0())->toBe(10.0);
    expect($brush->getY0())->toBe(20.0);
    expect($brush->getX1())->toBe(30.0);
    expect($brush->getY1())->toBe(40.0);
    expect($brush->getOuterRadius())->toBe(50.0);
});