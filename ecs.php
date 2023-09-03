<?php
/**
 * This file is part of the Dubas UUID Field - EspoCRM extension.
 *
 * DUBAS S.C. - contact@dubas.pro
 * Copyright (C) 2021-2023 Arkadiy Asuratov, Emil Dubielecki
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

$header = 'This file is part of the %s - EspoCRM extension.

%s
Copyright (C) %s-%s %s

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.';

return static function (\Symplify\EasyCodingStandard\Config\ECSConfig $ecsConfig) use ($header): void {
    $ecsConfig->paths([__DIR__ . '/src/files/custom', __DIR__ . '/src/scripts', __DIR__ . '/tests']);

    $ecsConfig->skip([
        \PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer::class,
    ]);

    $extension = json_decode(file_get_contents(__DIR__ . '/extension.json'));
    $ecsConfig->ruleWithConfiguration(\PhpCsFixer\Fixer\Comment\HeaderCommentFixer::class, [
        'header' => sprintf(
            $header,
            $extension->name,
            $extension->author,
            date('Y', strtotime($extension->releaseDate)),
            date('Y'),
            implode(', ', $extension->authors)
        ),
        'comment_type' => \PhpCsFixer\Fixer\Comment\HeaderCommentFixer::HEADER_PHPDOC,
        'location' => 'after_open',
        'separate' => 'bottom',
    ]);

    $ecsConfig->rules([
        \PHP_CodeSniffer\Standards\PSR2\Sniffs\Namespaces\UseDeclarationSniff::class,
        \PhpCsFixer\Fixer\Import\NoUnusedImportsFixer::class,
        \PhpCsFixer\Fixer\ClassNotation\OrderedClassElementsFixer::class,
        \PhpCsFixer\Fixer\StringNotation\SingleQuoteFixer::class,
    ]);

    $ecsConfig->ruleWithConfiguration(\PhpCsFixer\Fixer\Whitespace\NoExtraBlankLinesFixer::class, [
        'tokens' => [
            'use',
        ],
    ]);

    $ecsConfig->sets([
        \Symplify\EasyCodingStandard\ValueObject\Set\SetList::SPACES,
        \Symplify\EasyCodingStandard\ValueObject\Set\SetList::ARRAY,
        \Symplify\EasyCodingStandard\ValueObject\Set\SetList::DOCBLOCK,
        \Symplify\EasyCodingStandard\ValueObject\Set\SetList::PSR_12,
    ]);
};
