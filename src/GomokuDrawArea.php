<?php

namespace Kingbes\Libui\SDK;

use Kingbes\Libui\SDK\LibDrawArea;
use Kingbes\Libui\SDK\LibuiDrawContext;
use FFI\CData;
use Kingbes\Libui\Draw;
use Kingbes\Libui\DrawBrushType;
use Kingbes\Libui\DrawFillMode;

/**
 * 五子棋绘图区域示例 - 验证 LibDrawArea 抽象类设计
 * 
 * 演示如何使用 LibDrawArea 创建功能完整的绘图应用
 */
class GomokuDrawArea extends LibDrawArea
{
    private int $boardSize = 15;
    private int $cellSize = 30;
    private int $boardWidth;
    private int $boardHeight;
    private float $offsetX;
    private float $offsetY;
    private array $board = [];
    private int $currentPlayer = 1;

    public function __construct(int $width = 600, int $height = 600) {
        parent::__construct($width, $height);
        
        // 计算棋盘尺寸和偏移
        $this->boardWidth = ($this->boardSize - 1) * $this->cellSize;
        $this->boardHeight = ($this->boardSize - 1) * $this->cellSize;
        $this->offsetX = ($width - $this->boardWidth) / 2;
        $this->offsetY = ($height - $this->boardHeight) / 2;
        
        // 初始化棋盘数组
        $this->initializeBoard();
    }

    /**
     * 初始化棋盘数组
     */
    private function initializeBoard(): void {
        $this->board = [];
        for ($row = 0; $row < $this->boardSize; $row++) {
            $this->board[$row] = array_fill(0, $this->boardSize, 0);
        }
    }

    /**
     * 实现抽象方法：绘制棋盘和棋子
     * 使用长方形画网格线，棋盘背景色（正如你要求的功能）
     */
    protected function draw(CData $params): void {
        $width = $params->AreaWidth;
        $height = $params->AreaHeight;

        // 1. 绘制整个窗口背景（浅灰色）
        $this->drawBackground($params, $width, $height);
        
        // 2. 绘制棋盘背景（浅木色）
        $this->drawBoardBackground($params);
        
        // 3. 使用长方形绘制棋盘网格线
        $this->drawGridLines($params);
        
        // 4. 绘制棋子
        $this->drawStones($params);
    }

    /**
     * 绘制背景
     */
    private function drawBackground(CData $params, float $width, float $height): void {
        $backgroundBrush = Draw::createBrush(DrawBrushType::Solid, 240/255, 240/255, 240/255, 1.0); // 浅灰色
        $backgroundPath = Draw::createPath(DrawFillMode::Winding);
        Draw::pathAddRectangle($backgroundPath, 0, 0, $width, $height);
        Draw::pathEnd($backgroundPath);
        Draw::fill($params, $backgroundPath, $backgroundBrush);
    }

    /**
     * 绘制棋盘背景
     */
    private function drawBoardBackground(CData $params): void {
        $boardBrush = Draw::createBrush(DrawBrushType::Solid, 227/255, 213/255, 144/255, 1.0); // 浅木色
        $boardPath = Draw::createPath(DrawFillMode::Winding);
        Draw::pathAddRectangle($boardPath, $this->offsetX, $this->offsetY, $this->boardWidth, $this->boardHeight);
        Draw::pathEnd($boardPath);
        Draw::fill($params, $boardPath, $boardBrush);
    }

    /**
     * 使用长方形绘制棋盘网格线（核心功能）
     */
    private function drawGridLines(CData $params): void {
        $lineBrush = Draw::createBrush(DrawBrushType::Solid, 0.0, 0.0, 0.0, 1.0); // 黑色

        // 绘制垂直线 - 使用1像素宽的矩形
        for ($i = 0; $i < $this->boardSize; $i++) {
            $x = $this->offsetX + $i * $this->cellSize;
            $y1 = $this->offsetY;
            $y2 = $this->offsetY + $this->boardHeight;
            
            $linePath = Draw::createPath(DrawFillMode::Winding);
            Draw::pathAddRectangle($linePath, $x - 0.5, $y1, 1, $y2 - $y1); // 1像素宽的矩形
            Draw::pathEnd($linePath);
            Draw::fill($params, $linePath, $lineBrush);
        }

        // 绘制水平线 - 使用1像素高的矩形
        for ($i = 0; $i < $this->boardSize; $i++) {
            $y = $this->offsetY + $i * $this->cellSize;
            $x1 = $this->offsetX;
            $x2 = $this->offsetX + $this->boardWidth;
            
            $linePath = Draw::createPath(DrawFillMode::Winding);
            Draw::pathAddRectangle($linePath, $x1, $y - 0.5, $x2 - $x1, 1); // 1像素高的矩形
            Draw::pathEnd($linePath);
            Draw::fill($params, $linePath, $lineBrush);
        }
    }

    /**
     * 绘制棋子
     */
    private function drawStones(CData $params): void {
        for ($row = 0; $row < $this->boardSize; $row++) {
            for ($col = 0; $col < $this->boardSize; $col++) {
                if ($this->board[$row][$col] !== 0) {
                    $this->drawStone($params, $row, $col, $this->board[$row][$col]);
                }
            }
        }
    }

    /**
     * 绘制单个棋子
     */
    private function drawStone(CData $params, int $row, int $col, int $player): void {
        $x = $this->offsetX + $col * $this->cellSize;
        $y = $this->offsetY + $row * $this->cellSize;
        $radius = $this->cellSize / 2 - 2;

        // 创建圆形路径
        $stonePath = Draw::createPath(DrawFillMode::Winding);
        Draw::createPathFigureWithArc($stonePath, $x, $y, $radius, 0, 360, false);
        Draw::pathEnd($stonePath);

        // 根据玩家选择颜色
        if ($player === 1) {
            $stoneBrush = Draw::createBrush(DrawBrushType::Solid, 0.0, 0.0, 0.0, 1.0); // 黑子
        } else {
            $stoneBrush = Draw::createBrush(DrawBrushType::Solid, 1.0, 1.0, 1.0, 1.0); // 白子
        }

        Draw::fill($params, $stonePath, $stoneBrush);
    }

    /**
     * 实现抽象方法：处理鼠标点击事件
     */
    protected function onMouseClick(float $x, float $y, CData $mouseEvent): void {
        // 计算点击的棋盘格子
        $col = (int) round(($x - $this->offsetX) / $this->cellSize);
        $row = (int) round(($y - $this->offsetY) / $this->cellSize);

        // 验证点击是否在有效范围内
        if ($this->isValidPosition($row, $col)) {
            // 检查该位置是否为空
            if ($this->board[$row][$col] === 0) {
                // 放置棋子
                $this->placeStone($row, $col, $this->currentPlayer);
                
                // 切换玩家
                $this->switchPlayer();
            }
        }
    }

    /**
     * 验证位置是否有效
     */
    private function isValidPosition(int $row, int $col): bool {
        return $row >= 0 && $row < $this->boardSize && $col >= 0 && $col < $this->boardSize;
    }

    /**
     * 放置棋子
     */
    private function placeStone(int $row, int $col, int $player): void {
        $this->board[$row][$col] = $player;
    }

    /**
     * 切换当前玩家
     */
    private function switchPlayer(): void {
        $this->currentPlayer = ($this->currentPlayer === 1) ? 2 : 1;
    }

    /**
     * 获取当前玩家
     */
    public function getCurrentPlayer(): int {
        return $this->currentPlayer;
    }

    /**
     * 获取棋盘状态
     */
    public function getBoard(): array {
        return $this->board;
    }

    /**
     * 重新开始游戏
     */
    public function resetGame(): void {
        $this->initializeBoard();
        $this->currentPlayer = 1;
        $this->redraw();
    }

    /**
     * 实现抽象方法：创建句柄
     */
    protected function createHandle(): CData {
        // LibDrawArea 已经处理了句柄创建，这里返回 null
        return $this->getHandle();
    }

    /**
     * 检查是否有玩家获胜
     */
    public function checkWin(int $row, int $col): bool {
        $player = $this->board[$row][$col];
        if ($player === 0) return false;

        // 检查四个方向：水平、垂直、对角线
        $directions = [
            [[0, 1], [0, -1]],   // 水平
            [[1, 0], [-1, 0]],   // 垂直
            [[1, 1], [-1, -1]],  // 主对角线
            [[1, -1], [-1, 1]]   // 副对角线
        ];

        foreach ($directions as $direction) {
            $count = 1; // 包括当前位置
            
            // 检查两个方向
            foreach ($direction as [$dr, $dc]) {
                $r = $row + $dr;
                $c = $col + $dc;
                
                while ($this->isValidPosition($r, $c) && $this->board[$r][$c] === $player) {
                    $count++;
                    $r += $dr;
                    $c += $dc;
                }
            }
            
            if ($count >= 5) {
                return true;
            }
        }
        
        return false;
    }
}