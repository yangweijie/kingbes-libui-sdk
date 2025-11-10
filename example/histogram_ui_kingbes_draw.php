<?php

require dirname(__DIR__) . "/vendor/autoload.php";

use UI\UI;
use UI\Window;
use UI\Size;
use UI\Controls\Box;
use UI\Controls\Label;
use UI\Controls\Spinbox;
use UI\Area;
use UI\Area\DrawParams;
use Kingbes\Libui\Draw;
use Kingbes\Libui\DrawBrushType;
use Kingbes\Libui\DrawFillMode;
use Kingbes\Libui\DrawLineCap;
use Kingbes\Libui\DrawLineJoin;

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
            if ($this->area) {
                $this->area->redraw();
            }
        }
    }
    
    public function graphSize($areaWidth, $areaHeight) {
        $graphWidth = $areaWidth - self::X_OFF_LEFT - self::X_OFF_RIGHT;
        $graphHeight = $areaHeight - self::Y_OFF_TOP - self::Y_OFF_BOTTOM;
        return [$graphWidth, $graphHeight];
    }
    
    public function pointLocations($width, $height) {
        $xincr = $width / 9.0; // 10 - 1 to make the last point be at the end
        $yincr = $height / 100.0;
        
        $locations = [];
        foreach ($this->datapoints as $i => $value) {
            $val = 100 - $value;
            $locations[] = [
                'x' => self::X_OFF_LEFT + $xincr * $i,
                'y' => self::Y_OFF_TOP + $yincr * $val
            ];
        }
        return $locations;
    }
    
    // 创建图表路径
    public function graphPath($params, $width, $height, $shouldExtend) {
        $locations = $this->pointLocations($width, $height);
        
        // 创建路径
        $path = Draw::createPath(DrawFillMode::Winding);
        
        if (!empty($locations)) {
            // 移动到第一个点
            Draw::createPathFigure($path, $locations[0]['x'], $locations[0]['y']);
            
            // 连接所有点
            for ($i = 1; $i < count($locations); $i++) {
                Draw::pathLineTo($path, $locations[$i]['x'], $locations[$i]['y']);
            }
            
            // 如果需要扩展填充区域
            if ($shouldExtend) {
                // 连接到右下角
                Draw::pathLineTo($path, self::X_OFF_LEFT + $width, self::Y_OFF_TOP + $height);
                // 连接到左下角
                Draw::pathLineTo($path, self::X_OFF_LEFT, self::Y_OFF_TOP + $height);
                // 闭合路径
                Draw::pathCloseFigure($path);
            }
            
            // 结束路径定义
            Draw::pathEnd($path);
        }
        
        return $path;
    }
    
    public function launch() {
        // 初始化UI库
        UI::init();
        
        // 创建主窗口
        $window = new Window("直方图示例", new Size(640, 480), false);
        $window->setMargin(true);
        
        // 创建主容器
        $mainBox = new Box(0); // 0 = Horizontal
        $mainBox->setPadded(true);
        
        // 创建左侧控制面板
        $controlBox = new Box(1); // 1 = Vertical
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
            function ($handler, $areaObj, $params) use ($self) { // 绘图处理程序
                // 获取底层的绘制参数
                $drawParams = $params->getParams();
                
                // 获取区域尺寸
                $areaWidth = $params->getAreaWidth();
                $areaHeight = $params->getAreaHeight();
                
                // 填充背景为白色
                $whiteBrush = Draw::createBrush(DrawBrushType::Solid, 1.0, 1.0, 1.0, 1.0);
                $bgPath = Draw::createPath(DrawFillMode::Winding);
                Draw::pathAddRectangle($bgPath, 0, 0, $areaWidth, $areaHeight);
                Draw::pathEnd($bgPath);
                Draw::fill($drawParams, $bgPath, $whiteBrush);
                Draw::freePath($bgPath);
                
                // 计算图表尺寸
                list($graphWidth, $graphHeight) = $self->graphSize($areaWidth, $areaHeight);
                
                // 绘制坐标轴
                $axisPath = Draw::createPath(DrawFillMode::Winding);
                // Y轴
                Draw::createPathFigure($axisPath, self::X_OFF_LEFT, self::Y_OFF_TOP);
                Draw::pathLineTo($axisPath, self::X_OFF_LEFT, self::Y_OFF_TOP + $graphHeight);
                // X轴
                Draw::createPathFigure($axisPath, self::X_OFF_LEFT, self::Y_OFF_TOP + $graphHeight);
                Draw::pathLineTo($axisPath, self::X_OFF_LEFT + $graphWidth, self::Y_OFF_TOP + $graphHeight);
                Draw::pathEnd($axisPath);
                
                // 创建黑色笔刷用于坐标轴
                $blackBrush = Draw::createBrush(DrawBrushType::Solid, 0.0, 0.0, 0.0, 1.0);
                // 创建描边参数
                $strokeParams = Draw::createStrokeParams(
                    DrawLineCap::Flat,
                    DrawLineJoin::Miter,
                    DrawLineJoin::Miter,
                    2.0, // 线条粗细
                    10.0 // 斜接限制
                );
                
                // 绘制坐标轴
                Draw::Stroke($drawParams, $axisPath, $blackBrush, $strokeParams);
                Draw::freePath($axisPath);
                
                // 创建图表填充路径（半透明蓝色）
                $fillBrush = Draw::createBrush(
                    DrawBrushType::Solid,
                    0x1E / 0xFF,  // 红色分量
                    0x90 / 0xFF,  // 绿色分量
                    0xFF / 0xFF,  // 蓝色分量
                    0.5           // 50% 透明度
                );
                
                $fillPath = $self->graphPath($drawParams, $graphWidth, $graphHeight, true);
                Draw::fill($drawParams, $fillPath, $fillBrush);
                Draw::freePath($fillPath);
                
                // 创建图表线条路径（不透明蓝色）
                $lineBrush = Draw::createBrush(
                    DrawBrushType::Solid,
                    0x1E / 0xFF,  // 红色分量
                    0x90 / 0xFF,  // 绿色分量
                    0xFF / 0xFF,  // 蓝色分量
                    1.0           // 不透明度
                );
                
                $linePath = $self->graphPath($drawParams, $graphWidth, $graphHeight, false);
                $lineStrokeParams = Draw::createStrokeParams(
                    DrawLineCap::Flat,
                    DrawLineJoin::Miter,
                    DrawLineJoin::Miter,
                    2.0, // 线条粗细
                    10.0 // 斜接限制
                );
                Draw::Stroke($drawParams, $linePath, $lineBrush, $lineStrokeParams);
                Draw::freePath($linePath);
            }
        );
        
        // 将控件添加到主容器
        $mainBox->append($controlBox, false);
        $mainBox->append($this->area, true);
        
        // 设置窗口内容
        $window->setChild($mainBox);
        
        // 设置窗口关闭事件
        $window->onClose(function ($window) {
            echo "窗口关闭\n";
            UI::exit();
            return true;
        });
        
        // 显示窗口
        $window->show();
        
        // 运行应用
        UI::run();
    }
}

// 运行直方图示例
$histogram = new Histogram();
$histogram->launch();