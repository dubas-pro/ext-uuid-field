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

class GenerateUuid extends \Espo\Core\Hooks\Base
{
    public static $order = 9;

    public function beforeSave(Entity $entity, array $options = []): void
    {
        $uuidHelper = $this->getContainer()->get('uuidHelper');
        $fieldDefs = $this->getMetadata()->get(['entityDefs', $entity->getEntityType(), 'fields'], []);

        foreach ($fieldDefs as $fieldName => $defs) {
            if (isset($defs['type']) && $defs['type'] === 'uuid') {
                if (!empty($options['import']) && $entity->has($fieldName)) {
                    continue;
                }

                if ($entity->get($fieldName)) {
                    continue;
                }

                $uuidVersion = $this->getMetadata()->get(['entityDefs', $entity->getEntityType(), 'fields', $fieldName, 'uuidVersion'], '1');

                $uuid = $uuidHelper->getByVersion($uuidVersion);
                if ('' !== $uuid) {
                    $entity->set($fieldName, $uuid);
                }
            }
        }
    }

    protected function init(): void
    {
        $this->addDependency('metadata');
    }

    protected function getMetadata()
    {
        return $this->getInjection('metadata');
    }
}
