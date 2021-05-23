<?php

/*
 * This file is part of the Dubas UUID Field - EspoCRM extension.
 *
 * DUBAS S.C. - contact@dubas.pro
 * Copyright (C) 2021 Arkadiy Asuratov, Emil Dubielecki
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

use Espo\Core\Di;
use Espo\ORM\Entity;

class GenerateUuid implements
    Di\EntityManagerAware,
    Di\MetadataAware
{
    use Di\EntityManagerSetter;
    use Di\MetadataSetter;

    public static $order = 9;

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

                $uuidManager = $this->entityManager->getRepository('UuidManager')->storeEntityUuid($entity, $fieldName);

                $entity->set($fieldName, $uuidManager->get('name'));
            }
        }
    }
}
