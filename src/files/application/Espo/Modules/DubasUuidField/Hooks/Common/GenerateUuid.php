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

namespace Espo\Modules\DubasUuidField\Hooks\Common;

use Espo\ORM\Entity;
use Espo\Core\Di;
use Espo\Modules\DubasUuidField\Core\Helpers\Uuid;

class GenerateUuid implements Di\MetadataAware
{
    use Di\MetadataSetter;

    public static $order = 9;

    protected $uuid;

    public function __construct(Uuid $uuid)
    {
        $this->uuid = $uuid;
    }

    public function beforeSave(Entity $entity, array $options = []): void
    {
        $fieldDefs = $this->metadata->get(['entityDefs', $entity->getEntityType(), 'fields'], []);

        foreach ($fieldDefs as $fieldName => $defs) {
            if (isset($defs['type']) && $defs['type'] === 'uuid') {
                if (!empty($options['import']) && $entity->has($fieldName)) {
                    continue;
                }

                if ($entity->get($fieldName)) {
                    continue;
                }

                $uuidVersion = $this->metadata->get(['entityDefs', $entity->getEntityType(), 'fields', $fieldName, 'uuidVersion'], '1');

                $uuid = $this->uuid->getByVersion($uuidVersion);
                if ('' !== $uuid) {
                    $entity->set($fieldName, $uuid);
                }
            }
        }
    }
}
