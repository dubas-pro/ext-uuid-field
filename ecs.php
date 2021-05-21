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
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 *
 */

declare(strict_types=1);

use PhpCsFixer\Fixer\ClassNotation\ClassAttributesSeparationFixer;
use PhpCsFixer\Fixer\ClassNotation\ClassDefinitionFixer;
use PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer;
use PhpCsFixer\Fixer\Comment\HeaderCommentFixer;
use PhpCsFixer\Fixer\ControlStructure\NoUnneededCurlyBracesFixer;
use PhpCsFixer\Fixer\ControlStructure\NoUselessElseFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\ReturnNotation\NoUselessReturnFixer;
use PhpCsFixer\Fixer\StringNotation\SingleQuoteFixer;
use PhpCsFixer\Fixer\Whitespace\MethodChainingIndentationFixer;
use PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer;
use PhpCsFixer\Fixer\Whitespace\NoWhitespaceInBlankLineFixer;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->import(SetList::ARRAY);
    $containerConfigurator->import(SetList::CLEAN_CODE);
    $containerConfigurator->import(SetList::PSR_12);
    $containerConfigurator->import(SetList::PSR_1);

    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [
        __DIR__ . '/ecs.php',
        __DIR__ . '/rector.php',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);
    $parameters->set(Option::SKIP, [
        __DIR__ . '/vendor',
    ]);

    $services = $containerConfigurator->services();
    $services->set(MethodChainingIndentationFixer::class);
    $services->set(ConcatSpaceFixer::class)
        ->call('configure', [[
            'spacing' => 'one',
        ]]);
    $services->set(ClassAttributesSeparationFixer::class);
    $services->set(ClassDefinitionFixer::class)
        ->call('configure', [[
            'multi_line_extends_each_single_line' => true,
            'single_item_single_line' => true,
        ]]);
    $services->set(NoUnneededCurlyBracesFixer::class);
    $services->set(NoUselessElseFixer::class);
    $services->set(NoUselessReturnFixer::class);
    $services->set(SingleQuoteFixer::class);
    $services->set(OrderedClassElementsFixer::class);
    $services->set(NoExtraBlankLinesFixer::class)
        ->call('configure', [[
            'tokens' => ['use'],
        ]]);
    $services->set(NoWhitespaceInBlankLineFixer::class);
    $services->set(HeaderCommentFixer::class)
        ->call('configure', [[
            'header' => file_get_contents(__DIR__ . '/NOTICE'),
            'location' => 'after_open',
        ]]);
};
