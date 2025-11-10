<?php

require_once __DIR__ . '/../vendor/autoload.php';

// 包含 Pest 函数
require_once __DIR__ . '/../vendor/pestphp/pest/src/Functions.php';

// 模拟测试运行
echo "Running Pest tests...\n\n";

// 定义 expect 函数（如果尚未定义）
if (!function_exists('expect')) {
    function expect($value = null) {
        return new class($value) {
            private $value;
            
            public function __construct($value) {
                $this->value = $value;
            }
            
            public function toBe($expected) {
                if ($this->value !== $expected) {
                    throw new Exception("Expected {$this->value} to be {$expected}");
                }
                echo "  ✓ Passed\n";
                return $this;
            }
        };
    }
}

// 定义 it 函数（如果尚未定义）
if (!function_exists('it')) {
    function it($description, $callback) {
        echo "Running: {$description}\n";
        try {
            $callback();
            echo "  Test completed successfully\n";
        } catch (Exception $e) {
            echo "  ✗ Failed: " . $e->getMessage() . "\n";
        }
        echo "\n";
    }
}

// 运行 PointTest 中的测试
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

echo "All Pest tests completed.\n";