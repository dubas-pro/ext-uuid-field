<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\SetList;
use Rector\Set\ValueObject\DowngradeSetList;
use Rector\Set\ValueObject\DowngradeLevelSetList;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Php74\Rector\Property\TypedPropertyRector;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->sets([
        DowngradeLevelSetList::DOWN_TO_PHP_74,
        SetList::PHP_74,
        SetList::TYPE_DECLARATION_STRICT,
        SetList::CODE_QUALITY,
        SetList::NAMING,
    ]);

    $rectorConfig->autoloadPaths([
        __DIR__ . '/site',
    ]);

    $rectorConfig->paths([
        __DIR__ . '/ecs.php',
        __DIR__ . '/rector.php',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    $rectorConfig->skip([
        __DIR__ . '/src/*/vendor/*',
    ]);

    $rectorConfig->phpVersion(PhpVersion::PHP_74);

    $rectorConfig->importNames();
    $rectorConfig->importShortClasses();

    // register single rule
    $rectorConfig->rule(TypedPropertyRector::class);
};
