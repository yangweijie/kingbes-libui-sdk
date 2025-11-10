<?php

it('throws invalid argument exception', function () {
    expect(fn() => throw new UI\Exception\InvalidArgumentException("Test exception"))->toThrow(UI\Exception\InvalidArgumentException::class);
});

it('throws runtime exception', function () {
    expect(fn() => throw new UI\Exception\RuntimeException("Test exception"))->toThrow(UI\Exception\RuntimeException::class);
});