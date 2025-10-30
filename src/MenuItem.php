<?php

namespace UI;

use FFI\CData;
use Kingbes\Libui\Base;

/**
 * Menu Item
 */
class MenuItem extends Base
{
    /**
     * @var CData The underlying uiMenuItem
     */
    protected CData $menuItem;

    /**
     * Construct a new MenuItem
     *
     * @param CData $menuItem The underlying uiMenuItem
     */
    public function __construct(CData $menuItem)
    {
        $this->menuItem = $menuItem;
    }

    /**
     * Disable Menu Item
     *
     * @return void
     */
    public function disable(): void
    {
        self::ffi()->uiMenuItemDisable($this->menuItem);
    }

    /**
     * Enable Menu Item
     *
     * @return void
     */
    public function enable(): void
    {
        self::ffi()->uiMenuItemEnable($this->menuItem);
    }

    /**
     * Detect Checked
     *
     * @return bool
     */
    public function isChecked(): bool
    {
        return (bool)self::ffi()->uiMenuItemChecked($this->menuItem);
    }

    /**
     * On Click Callback
     *
     * @param callable $callback Callback function
     * @return void
     */
    public function onClick(callable $callback): void
    {
        $cCallback = function ($sender, $window, $data) use ($callback) {
            $callback(new self($sender), $window, $data);
        };
        self::ffi()->uiMenuItemOnClicked($this->menuItem, $cCallback, null);
    }

    /**
     * Set Checked
     *
     * @param bool $checked
     * @return void
     */
    public function setChecked(bool $checked): void
    {
        self::ffi()->uiMenuItemSetChecked($this->menuItem, $checked ? 1 : 0);
    }

    /**
     * Get the underlying uiMenuItem
     *
     * @return CData
     */
    public function getHandle(): CData
    {
        return $this->menuItem;
    }
}