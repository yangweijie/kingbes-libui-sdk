<?php

namespace UI;

use FFI\CData;
use Kingbes\Libui\Base;

/**
 * Menu
 */
class Menu extends Base
{
    /**
     * @var CData The underlying uiMenu
     */
    protected CData $menu;

    /**
     * Construct a new Menu
     *
     * @param string $name Menu label
     */
    public function __construct(string $name)
    {
        $this->menu = self::ffi()->uiNewMenu($name);
    }

    /**
     * Append Menu Item
     *
     * @param string $name Menu item text
     * @return MenuItem
     */
    public function append(string $name): MenuItem
    {
        $item = self::ffi()->uiMenuAppendItem($this->menu, $name);
        return new MenuItem($item);
    }

    /**
     * Append About Menu Item
     *
     * @return MenuItem
     */
    public function appendAbout(): MenuItem
    {
        $item = self::ffi()->uiMenuAppendAboutItem($this->menu);
        return new MenuItem($item);
    }

    /**
     * Append Checkable Menu Item
     *
     * @param string $name Menu item text
     * @return MenuItem
     */
    public function appendCheck(string $name): MenuItem
    {
        $item = self::ffi()->uiMenuAppendCheckItem($this->menu, $name);
        return new MenuItem($item);
    }

    /**
     * Append Preferences Menu Item
     *
     * @return MenuItem
     */
    public function appendPreferences(): MenuItem
    {
        $item = self::ffi()->uiMenuAppendPreferencesItem($this->menu);
        return new MenuItem($item);
    }

    /**
     * Append Quit Menu Item
     *
     * @return MenuItem
     */
    public function appendQuit(): MenuItem
    {
        $item = self::ffi()->uiMenuAppendQuitItem($this->menu);
        return new MenuItem($item);
    }

    /**
     * Append Menu Item Separator
     *
     * @return void
     */
    public function appendSeparator(): void
    {
        self::ffi()->uiMenuAppendSeparator($this->menu);
    }

    /**
     * Get the underlying uiMenu
     *
     * @return CData
     */
    public function getHandle(): CData
    {
        return $this->menu;
    }
}