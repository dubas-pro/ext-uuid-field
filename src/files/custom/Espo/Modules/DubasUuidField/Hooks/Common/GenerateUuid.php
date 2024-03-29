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

namespace Espo\Modules\DubasUuidField\Hooks\Common;

use Espo\Modules\DubasUuidField\Tools\FieldProcessing\Uuid\BeforeSaveProcessor as Processor;
use Espo\ORM\Entity;

class GenerateUuid
{
    public function __construct(
        private Processor $processor
    ) {
    }

    /**
     * @param array<string,mixed> $options Options.
     */
    public function beforeSave(Entity $entity, array $options = []): void
    {
        $this->processor->process($entity, $options);
    }
}
