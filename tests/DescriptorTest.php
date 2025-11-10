<?php

it('creates a descriptor with correct properties', function () {
    $descriptor = new UI\Draw\Text\Font\Descriptor("Arial", 12.0, UI\Draw\Text\Font\Weight::NORMAL, UI\Draw\Text\Font\Italic::NORMAL, UI\Draw\Text\Font\Stretch::NORMAL);
    expect($descriptor->getFamily())->toBe("Arial");
    expect($descriptor->getSize())->toBe(12.0);
    expect($descriptor->getWeight())->toBe(UI\Draw\Text\Font\Weight::NORMAL);
    expect($descriptor->getItalic())->toBe(UI\Draw\Text\Font\Italic::NORMAL);
    expect($descriptor->getStretch())->toBe(UI\Draw\Text\Font\Stretch::NORMAL);
});

it('sets descriptor properties', function () {
    $descriptor = new UI\Draw\Text\Font\Descriptor("Arial", 12.0, UI\Draw\Text\Font\Weight::NORMAL, UI\Draw\Text\Font\Italic::NORMAL, UI\Draw\Text\Font\Stretch::NORMAL);
    $descriptor->setFamily("Times New Roman");
    $descriptor->setSize(14.0);
    $descriptor->setWeight(UI\Draw\Text\Font\Weight::BOLD);
    $descriptor->setItalic(UI\Draw\Text\Font\Italic::ITALIC);
    $descriptor->setStretch(UI\Draw\Text\Font\Stretch::EXPANDED);
    expect($descriptor->getFamily())->toBe("Times New Roman");
    expect($descriptor->getSize())->toBe(14.0);
    expect($descriptor->getWeight())->toBe(UI\Draw\Text\Font\Weight::BOLD);
    expect($descriptor->getItalic())->toBe(UI\Draw\Text\Font\Italic::ITALIC);
    expect($descriptor->getStretch())->toBe(UI\Draw\Text\Font\Stretch::EXPANDED);
});