<?php
require dirname(__DIR__) . "/vendor/autoload.php";

use UI\UI;
use UI\Window;
use UI\Size;
use UI\Controls\Box;
use UI\Controls\Orientation;
use UI\Controls\Label;
use UI\Controls\Spinbox;
use UI\Area;

class Histogram {
    const X_OFF_LEFT = 20;
    const Y_OFF_TOP = 20;
    const X_OFF_RIGHT = 20;
    const Y_OFF_BOTTOM = 20;
    const POINT_RADIUS = 5;
    
    private $datapoints;
    private $area;
    
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
            // 注意：在UI库中，我们可能需要不同的方式来触发重绘
            echo "数据点 $index 更新为 $value\n";
        }
    }
    
    public function launch() {
        // 初始化UI库
        UI::init();
        
        // 创建主窗口
        $window = new Window("直方图示例", new Size(640, 480), true);
        $window->setMargin(true);
        
        // 创建主容器
        $mainBox = new Box(Orientation::Horizontal);  // 修正常量引用
        $mainBox->setPadded(true);
        
        // 创建左侧控制面板
        $controlBox = new Box(Orientation::Vertical);  // 修正常量引用
        $controlBox->setPadded(true);
        
        // 添加标题
        $titleLabel = new Label("数据点控制:");
        $controlBox->append($titleLabel, false);
        
        // 添加数据点控制
        for ($i = 0; $i < 10; $i++) {
            $label = new Label("数据点 " . ($i + 1) . ":");
            $controlBox->append($label, false);
            
            $spinbox = new Spinbox(0, 100);
            $spinbox->setValue($this->datapoints[$i]);
            
            // 保存引用以便后续更新
            $self = $this;
            $spinbox->onChange(function($sb) use ($self, $i) {
                $value = $sb->getValue();
                $self->setDatapoint($i, $value);
            });
            
            $controlBox->append($spinbox, false);
        }
        
        // 创建绘图区域
        $self = $this;
        $this->area = new Area(
            function ($area, $params) use ($self) { // 绘图处理程序
                echo "绘图区域已创建\n";
            }
        );
        
        // 将控件添加到主容器
        $mainBox->append($controlBox, false);
        $mainBox->append($this->area, true);
        
        // 设置窗口内容
        $window->setChild($mainBox);
        
        // 显示窗口
        $window->show();
        
        // 运行应用
        UI::run();
    }
}

// 运行直方图示例
$histogram = new Histogram();
$histogram->launch();