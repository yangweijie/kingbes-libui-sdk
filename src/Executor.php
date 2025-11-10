<?php

namespace UI;

/**
 * Execution Scheduler
 */
class Executor
{
    /**
     * @var int The interval in seconds
     */
    protected float $interval;

    /**
     * @var callable The callback to execute
     */
    protected $callback;

    /**
     * @var bool Whether the executor is active
     */
    protected bool $active = false;

    /**
     * Construct a new Executor
     *
     * @param float $interval Interval in seconds
     * @param callable $callback Callback function
     */
    public function __construct(float $interval, callable $callback)
    {
        $this->interval = $interval;
        $this->callback = $callback;
    }

    /**
     * Start the executor
     *
     * @return void
     */
    public function start(): void
    {
        if ($this->active) {
            return;
        }

        $this->active = true;
        
        // 在实际实现中，这里应该与 UI 库的事件循环集成
        // 由于这是一个封装库，我们只设置状态
    }

    /**
     * Stop the executor
     *
     * @return void
     */
    public function stop(): void
    {
        $this->active = false;
    }

    /**
     * Execution Callback
     *
     * @param callable $callback Callback function
     * @return void
     */
    public function onExecute(callable $callback): void
    {
        $this->callback = $callback;
    }

    /**
     * Interval Manipulation
     *
     * @param float $interval Interval in seconds
     * @return void
     */
    public function setInterval(float $interval): void
    {
        $this->interval = $interval;
    }

    /**
     * Kill the executor
     *
     * @return void
     */
    public function kill(): void
    {
        $this->stop();
    }

    /**
     * Check if the executor is active
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }
    
    /**
     * Execute the callback if active
     *
     * @return void
     */
    public function execute(): void
    {
        if ($this->active && $this->callback) {
            ($this->callback)();
        }
    }
}