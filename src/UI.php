<?php

namespace UI;

use Kingbes\Libui\App as LibuiApp;

class UI
{
    public static function init(): void
    {
        LibuiApp::init();
    }

    public static function run(): void
    {
        LibuiApp::main();
    }

    public static function exit(): void
    {
        LibuiApp::quit();
    }
}