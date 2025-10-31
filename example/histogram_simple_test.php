<?php
require dirname(__DIR__) . "/vendor/autoload.php";

// 添加错误报告
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 简化的 Histogram 类定义用于测试
class Histogram {
    private $datapoints;
    
    public function __construct() {
        // 初始化数据点，随机生成0-90之间的值
        $this->datapoints = [];
        for ($i = 0; $i < 10; $i++) {
            $this->datapoints[] = rand(0, 90);
        }
    }
    
    public function getDatapoints() {
        return $this->datapoints;
    }
    
    public function setDatapoint($index, $value) {
        if (isset($this->datapoints[$index])) {
            $this->datapoints[$index] = $value;
        }
    }
}

echo "开始测试 Histogram 类...\n";

try {
    // 创建直方图实例
    $histogram = new Histogram();
    echo "Histogram 类创建成功\n";
    
    // 测试数据点获取
    $datapoints = $histogram->getDatapoints();
    echo "数据点数量: " . count($datapoints) . "\n";
    
    // 测试设置数据点
    $histogram->setDatapoint(0, 50);
    echo "数据点设置成功\n";
    
    echo "Histogram 类测试完成\n";
} catch (Exception $e) {
    echo "异常: " . $e->getMessage() . "\n";
    echo "文件: " . $e->getFile() . "\n";
    echo "行号: " . $e->getLine() . "\n";
} catch (Error $e) {
    echo "错误: " . $e->getMessage() . "\n";
    echo "文件: " . $e->getFile() . "\n";
    echo "行号: " . $e->getLine() . "\n";
}