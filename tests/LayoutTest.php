<?php

it('creates a layout with correct properties', function () {
    $font = new UI\Draw\Text\Font("Arial", 12.0, UI\Draw\Text\Font\Weight::NORMAL, UI\Draw\Text\Font\Italic::NORMAL, UI\Draw\Text\Font\Stretch::NORMAL);
    $layout = new UI\Draw\Text\Layout("Hello World", $font, 100.0, UI\Draw\Text\Align::LEFT);
    expect($layout->getText())->toBe("Hello World");
    expect($layout->getFont())->toBe($font);
    expect($layout->getWidth())->toBe(100.0);
    expect($layout->getAlign())->toBe(UI\Draw\Text\Align::LEFT);
});

it('sets layout properties', function () {
    $font1 = new UI\Draw\Text\Font("Arial", 12.0, UI\Draw\Text\Font\Weight::NORMAL, UI\Draw\Text\Font\Italic::NORMAL, UI\Draw\Text\Font\Stretch::NORMAL);
    $font2 = new UI\Draw\Text\Font("Times New Roman", 14.0, UI\Draw\Text\Font\Weight::BOLD, UI\Draw\Text\Font\Italic::ITALIC, UI\Draw\Text\Font\Stretch::EXPANDED);
    $layout = new UI\Draw\Text\Layout("Hello World", $font1, 100.0, UI\Draw\Text\Align::LEFT);
    $layout->setText("New Text");
    $layout->setFont($font2);
    $layout->setWidth(200.0);
    $layout->setAlign(UI\Draw\Text\Align::CENTER);
    expect($layout->getText())->toBe("New Text");
    expect($layout->getFont())->toBe($font2);
    expect($layout->getWidth())->toBe(200.0);
    expect($layout->getAlign())->toBe(UI\Draw\Text\Align::CENTER);
});