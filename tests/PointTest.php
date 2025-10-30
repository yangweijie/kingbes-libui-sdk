<?php

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