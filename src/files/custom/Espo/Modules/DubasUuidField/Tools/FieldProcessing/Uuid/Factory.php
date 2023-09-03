<?php
/**
 * This file is part of the Dubas UUID Field - EspoCRM extension.
 *
 * dubas s.c. - contact@dubas.pro
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

namespace Espo\Modules\DubasUuidField\Tools\FieldProcessing\Uuid;

use Espo\Core\InjectableFactory;
use Espo\Core\Utils\Metadata;
use RuntimeException;

class Factory
{
    public function __construct(
        private Metadata $metadata,
        private InjectableFactory $injectableFactory
    ) {
    }

    public function create(string $version): Uuid
    {
        /** @var ?class-string<Uuid> $className */
        $className = $this->metadata->get(['app', 'uuid', 'uuidVersionClassNameMap', $version]);

        if (!$className) {
            throw new RuntimeException("Unsupported version '{$version}'.");
        }

        return $this->injectableFactory->create($className);
    }
}
