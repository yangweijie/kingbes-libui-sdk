#!/usr/bin/env php
<?php

require_once __DIR__ . '/../../vendor/autoload.php';

// 简单测试
it('works', function () {
    expect(true)->toBeTrue();
});

// 测试 UI 类
it('creates point', function () {
    $point = new UI\Point(10.0, 20.0);
    expect($point->getX())->toBe(10.0);
    expect($point->getY())->toBe(20.0);
});