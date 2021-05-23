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

namespace Espo\Modules\DubasUuidField\Repositories;

use Espo\Modules\DubasUuidField\Core\Di;
use Espo\ORM\Entity;

class UuidManager extends \Espo\Core\Repositories\Database implements Di\UuidAware
{
    use Di\UuidSetter;

    protected $processFieldsAfterSaveDisabled = true;

    protected $processFieldsAfterRemoveDisabled = true;

    public function storeEntityUuid(Entity $parent, string $fieldName): Entity
    {
        $uuidVersion = $this->metadata->get(['entityDefs', $parent->getEntityType(), 'fields', $fieldName, 'uuidVersion'], '1');

        $uuidManager = $this
            ->select(['name'])
            ->where([
                'fieldName' => $fieldName,
                'parentType' => $parent->getEntityType(),
                'parentId' => $parent->id,
            ])
            ->findOne();

        $uuid = $this->uuid->generateByVersion($uuidVersion);
        if ($parent->hasAttribute($fieldName)) {
            $uuid = $parent->get($fieldName) ?? $uuid;
        }

        if ($uuidManager === null) {
            $uuidManager = $this->getNew();
            $uuidManager->set([
                'name' => $uuid,
                'parentId' => $parent->id,
                'parentType' => $parent->getEntityType(),
                'fieldName' => $fieldName,
                'uuidVersion' => $uuidVersion,
            ]);

            $this->save($uuidManager, [
                'silent' => true,
                'skipHooks' => true,
            ]);
        }

        return $uuidManager;
    }
}
