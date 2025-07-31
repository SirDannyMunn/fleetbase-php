<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\Php80\Rector\Class_\ClassPropertyAssignToConstructorPromotionRector;
use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    // Define what rule sets you want to apply
    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_81,
        SetList::CODE_QUALITY,
        SetList::DEAD_CODE,
        SetList::TYPE_DECLARATION,
        SetList::EARLY_RETURN,
    ]);

    // Additional PHP 8.1 specific rules
    $rectorConfig->rules([
        ClassPropertyAssignToConstructorPromotionRector::class,
        InlineConstructorDefaultToPropertyRector::class,
    ]);

    // Skip some rules that might be too aggressive for this codebase
    $rectorConfig->skip([
        // Skip some aggressive transformations
        \Rector\CodeQuality\Rector\ClassMethod\LocallyCalledStaticMethodToNonStaticRector::class,
    ]);

    // Import PHP built-in function names
    $rectorConfig->importNames();
    $rectorConfig->importShortClasses();

    // Parallel processing
    $rectorConfig->parallel();
};