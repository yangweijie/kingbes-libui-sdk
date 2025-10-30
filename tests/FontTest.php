<?php

it('creates a font with correct properties', function () {
    $font = new UI\Draw\Text\Font("Arial", 12.0, UI\Draw\Text\Font\Weight::NORMAL, UI\Draw\Text\Font\Italic::NORMAL, UI\Draw\Text\Font\Stretch::NORMAL);
    expect($font->getFamily())->toBe("Arial");
    expect($font->getSize())->toBe(12.0);
    expect($font->getWeight())->toBe(UI\Draw\Text\Font\Weight::NORMAL);
    expect($font->getItalic())->toBe(UI\Draw\Text\Font\Italic::NORMAL);
    expect($font->getStretch())->toBe(UI\Draw\Text\Font\Stretch::NORMAL);
});

it('sets font properties', function () {
    $font = new UI\Draw\Text\Font("Arial", 12.0);
    $font->setFamily("Times New Roman");
    $font->setSize(14.0);
    $font->setWeight(UI\Draw\Text\Font\Weight::BOLD);
    $font->setItalic(UI\Draw\Text\Font\Italic::ITALIC);
    $font->setStretch(UI\Draw\Text\Font\Stretch::EXPANDED);
    expect($font->getFamily())->toBe("Times New Roman");
    expect($font->getSize())->toBe(14.0);
    expect($font->getWeight())->toBe(UI\Draw\Text\Font\Weight::BOLD);
    expect($font->getItalic())->toBe(UI\Draw\Text\Font\Italic::ITALIC);
    expect($font->getStretch())->toBe(UI\Draw\Text\Font\Stretch::EXPANDED);
});