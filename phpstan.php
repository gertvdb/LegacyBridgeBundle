<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\PHPStanPHPConfig\ValueObject\Level;
use Symplify\PHPStanPHPConfig\ValueObject\Option;

return static function (ContainerConfigurator $containerConfigurator): void {
    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::LEVEL, Level::LEVEL_0);

    $parameters->set(
        Option::PATHS,
        [
            __DIR__ . '/src',
            __DIR__ . '/tests'
        ]
    );

    $parameters->set(Option::PARALLEL_MAX_PROCESSES, 6);
    $parameters->set(Option::REPORT_UNMATCHED_IGNORED_ERRORS, false);

    $containerConfigurator->import(__DIR__ . '/vendor/phpstan/phpstan/conf/bleedingEdge.neon');
    $containerConfigurator->import(__DIR__ . '/vendor/symplify/phpstan-extensions/config/config.neon');

};
