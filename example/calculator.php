<?php
require dirname(__DIR__) . "/vendor/autoload.php";

use UI\Controls\Box;
use UI\Controls\Orientation;
use UI\Size;
use UI\Window;
use UI\Controls\Grid;
use UI\Controls\Entry;
use UI\Controls\MultilineEntry;
use UI\Controls\Button;
use UI\UI;

class Calculator
{
    private Window $win;
    private MultilineEntry $formulaDisplay;
    private Entry $resultDisplay;
    private Grid $grid;
    private string $operator = '';
    private float $firstNum = 0;
    private bool $shouldClearDisplay = false;
    private string $currentFormula = '';
    private ?float $lastResult = null;

    public function __construct()
    {
        UI::init();
        $this->win = new Window('PHP 计算器', new Size(300, 400));

        // 主容器使用垂直 Box，上边是显示屏，下边是按钮网格
        $mainBox = new Box(Orientation::Vertical);
        $mainBox->setPadded(true);
        $this->win->setChild($mainBox);

        // 创建显示屏容器
        $displayBox = new Box(Orientation::Vertical);
        $mainBox->append($displayBox, 2); // 设置权重为2，使显示区域占据更多空间

        // 创建公式显示屏（多行文本框，高度是结果的2倍）
        $this->formulaDisplay = new MultilineEntry();
        $this->formulaDisplay->setText('');
        $this->formulaDisplay->setReadOnly(true);
        $displayBox->append($this->formulaDisplay, 2); // 设置权重为2，使高度是结果的2倍

        // 创建结果显示屏（单行文本框）
        $this->resultDisplay = new Entry();
        $this->resultDisplay->setText('=0');
        $this->resultDisplay->setReadOnly(true);
        $displayBox->append($this->resultDisplay, 1); // 设置权重为1

        // 创建按钮网格
        $this->grid = new Grid();
        $this->grid->setPadded(true);
        $mainBox->append($this->grid, true);

        // 定义按钮布局
        $buttons = [
            ['C', '<', '%', '/'],
            ['7', '8', '9', '*'],
            ['4', '5', '6', '-'],
            ['1', '2', '3', '+'],
            ['0', '.', '='],
        ];

        // 循环创建并放置按钮
        foreach ($buttons as $row => $buttonRow) {
            foreach ($buttonRow as $col => $text) {
                $button = new Button($text);
                $xspan = ($text === '0') ? 2 : 1; // '0' 按钮跨两列
                $col_adj = ($text === '=' || $text === '.') ? $col + 1 : $col; // 调整 '0' 之后的列

                $this->grid->append($button, $col_adj, $row, $xspan, 1, true, Grid::Fill, true, Grid::Fill);
                $button->onClick(fn() => $this->onButtonClick($text));
            }
        }
    }

    public function run(): void
    {
        $this->win->show();
        // 启动主循环
        UI::run();
    }

    private function updateDisplays(): void
    {
        $this->formulaDisplay->setText($this->currentFormula);
        if ($this->currentFormula === '') {
            $this->resultDisplay->setText('=0');
        }
    }

    private function calculateResult(): float
    {
        // 使用更安全的方式计算表达式
        try {
            // 替换表达式中的数字和运算符，确保安全计算
            $expression = $this->currentFormula;
            // 验证表达式只包含数字、小数点和运算符
        if (preg_match('/^[0-9+\-*\/%.() ]+$/', $expression)) {
                // 使用 eval 计算表达式结果（仅用于演示）
                return eval("return $expression;");
            }
        } catch (Error $e) {
            // 如果计算出错，返回0
        }
        return 0;
    }

    private function onButtonClick(string $text): void
    {
        if (is_numeric($text) || $text === '.') {
            if ($this->shouldClearDisplay) {
                $this->currentFormula = $this->lastResult !== null ? (string)$this->lastResult : '';
                $this->shouldClearDisplay = false;
            }
            $this->currentFormula .= $text;
            $this->updateDisplays();
        } elseif (in_array($text, ['+', '-', '*', '/', '%'])) {
            // 如果应该清除显示，则使用上次的结果作为新的开始
            if ($this->shouldClearDisplay) {
                if ($this->lastResult !== null) {
                    $this->currentFormula = $this->lastResult . $text;
                } else {
                    $this->currentFormula = '';
                }
                $this->shouldClearDisplay = false;
            } else {
                // 如果当前公式以运算符结尾，则替换运算符
                if (preg_match('/[+\-*\/%]$/', $this->currentFormula)) {
                    $this->currentFormula = preg_replace('/[+\-*\/%]$/', $text, $this->currentFormula);
                } else if ($this->currentFormula !== '') {
                    $this->currentFormula .= $text;
                }
            }
            $this->updateDisplays();
        } elseif ($text === 'C') {
            $this->currentFormula = '';
            $this->operator = '';
            $this->shouldClearDisplay = false;
            $this->lastResult = null;
            $this->resultDisplay->setText('=0');
            $this->updateDisplays();
        } elseif ($text === '<') {
            if ($this->currentFormula !== '') {
                $this->currentFormula = substr($this->currentFormula, 0, -1);
            }
            $this->updateDisplays();
        } elseif ($text === '=') {
            if ($this->currentFormula !== '') {
                $result = $this->calculateResult();
                $this->resultDisplay->setText('=' . $result);
                // 保存结果用于后续计算
                $this->lastResult = $result;
                $this->shouldClearDisplay = true;
            }
        }
    }
}

(new Calculator())->run();