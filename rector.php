<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Symfony\Set\SymfonySetList;

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/EMS',
        __DIR__ . '/elasticms-admin/src',
        __DIR__ . '/elasticms-cli/src',
        __DIR__ . '/elasticms-web/src',
        __DIR__ . '/elasticms-admin/tests',
        __DIR__ . '/elasticms-cli/tests',
        __DIR__ . '/elasticms-web/tests',
    ]);

    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);

    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_81,
        SymfonySetList::SYMFONY_54,
        SymfonySetList::SYMFONY_CODE_QUALITY,
        SymfonySetList::SYMFONY_CONSTRUCTOR_INJECTION,
    ]);

    $rectorConfig->importNames();
    $rectorConfig->importShortClasses(false);
};
