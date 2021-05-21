<?php

/*
 * This file is part of the Dubas UUID Field package.
 *
 * Copyright (C) 2021 DUBAS - Emil Dubielecki & Arkadiy Asuratov S.C.
 *
 * This program is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License
 * as published by the Free Software Foundation,
 * either version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 *
 */

declare(strict_types=1);

use Rector\CodingStyle\Rector\FuncCall\PreslashSimpleFunctionRector;
use Rector\CodingStyle\Rector\If_\NullableCompareToNullRector;
use Rector\Core\Configuration\Option;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Set\ValueObject\DowngradeSetList;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;
use Rector\TypeDeclaration\Rector\FunctionLike\ParamTypeDeclarationRector;
use Rector\TypeDeclaration\Rector\Param\ParamTypeFromStrictTypedPropertyRector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(DowngradeSetList::PHP_74);
    $containerConfigurator->import(SetList::PHP_73);
    $containerConfigurator->import(SetList::CODE_QUALITY);
    $containerConfigurator->import(SetList::DEAD_CODE);

    $parameters = $containerConfigurator->parameters();

    $parameters->set(Option::PHP_VERSION_FEATURES, PhpVersion::PHP_73);

    $parameters->set(Option::PATHS, [
        __DIR__ . '/ecs.php',
        __DIR__ . '/rector.php',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    $parameters->set(Option::AUTOLOAD_PATHS, [
        __DIR__ . '/site',
    ]);

    $parameters->set(Option::SKIP, [
        __DIR__ . '**/vendor/**',
    ]);

    $services = $containerConfigurator->services();

    $services->set(NullableCompareToNullRector::class);
    $services->set(PreslashSimpleFunctionRector::class);
    $services->set(AddVoidReturnTypeWhereNoReturnRector::class);
    $services->set(ParamTypeFromStrictTypedPropertyRector::class);
    $services->set(ParamTypeDeclarationRector::class);
};
