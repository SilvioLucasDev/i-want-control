<?php declare(strict_types = 1);

use Rector\CodeQuality\Rector\Identical\FlipTypeControlToUseExclusiveTypeRector;
use Rector\Config\RectorConfig;
use Rector\DeadCode\Rector\ClassMethod\RemoveParentDelegatingConstructorRector;

return RectorConfig::configure()
    ->withCache(__DIR__ . '/.rector-cache')
    ->withPaths([
        __DIR__ . '/app',
        __DIR__ . '/bootstrap/app.php',
        __DIR__ . '/database',
        __DIR__ . '/tests',
    ])
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        typeDeclarations: true,
        privatization: true,
        earlyReturn: true,
    )
    ->withSkip([
        FlipTypeControlToUseExclusiveTypeRector::class,
        RemoveParentDelegatingConstructorRector::class,
    ])
    ->withPhpSets();
