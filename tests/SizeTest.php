<?php

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