<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\FuncCall\CompactToVariablesRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;
use Rector\ValueObject\PhpVersion;
use RectorLaravel\Set\LaravelLevelSetList;

return static function (RectorConfig $rectorConfig): void {
    // Paths to analyze
    $rectorConfig->paths([
        __DIR__.'/app',
        __DIR__.'/config',
        __DIR__.'/database',
        __DIR__.'/resources',
        __DIR__.'/routes',
        __DIR__.'/tests',
        __DIR__.'/Modules',
    ]);

    // Skip specific rules
    $rectorConfig->skip([
        CompactToVariablesRector::class,
        __DIR__.'/Modules/*/Tests',
    ]);

    // Enable caching for Rector (cacheClass is deprecated)
    $rectorConfig->cacheDirectory(__DIR__.'/storage/rector');

    // Apply Rector sets for Laravel & general code quality
    $rectorConfig->sets([
        LaravelLevelSetList::UP_TO_LARAVEL_110,
        SetList::CODE_QUALITY,
    ]);

    // Define PHP version for Rector (use PHP_83)
    $rectorConfig->phpVersion(PHP_VERSION_ID >= 80300 ? PhpVersion::PHP_83 : PhpVersion::PHP_82);
};
