<?php
/**
 * This file is part of the Dubas UUID Field - EspoCRM extension.
 *
 * dubas s.c. - contact@dubas.pro
 * Copyright (C) 2021-2022 Arkadiy Asuratov, Emil Dubielecki
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

use Espo\Core\ORM\EntityManager;
use Espo\Core\Utils\Metadata;
use Espo\ORM\Entity;
use Espo\Modules\DubasUuidField\Entities\UuidManager as UuidManagerEntity;
use Espo\Modules\DubasUuidField\Repositories\UuidManager as UuidManagerRepository;

class GenerateUuid
{
    public static $order = 9;

    private EntityManager $entityManager;

    private Metadata $metadata;

    public function __construct(
        EntityManager $entityManager,
        Metadata $metadata
    ) {
        $this->entityManager = $entityManager;
        $this->metadata = $metadata;
    }

    public function beforeSave(Entity $entity, array $options = []): void
    {
        $fieldDefs = $this->metadata->get(['entityDefs', $entity->getEntityType(), 'fields'], []);
        foreach ($fieldDefs as $fieldName => $defs) {
            if (isset($defs['type']) && $defs['type'] === 'uuid') {
                // Do not generate uuid during import.
                if (!empty($options['import']) && $entity->has($fieldName)) {
                    continue;
                }

                // Do not generate if uuid exists.
                if ($entity->get($fieldName)) {
                    continue;
                }

                /** @var UuidManagerRepository $uuidManagerRepository */
                $uuidManagerRepository = $this->entityManager->getRepository(UuidManagerEntity::ENTITY_TYPE);

                $uuidManager = $uuidManagerRepository->storeEntityUuid($entity, $fieldName);

                $entity->set($fieldName, $uuidManager->get('name'));
            }
        }
    }
}
