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

use Espo\Core\ORM\EntityManager;
use Espo\Modules\DubasUuidField\Tools\FieldProcessing\Uuid\Factory as UuidFactory;
use Espo\ORM\Entity;

class BeforeSaveProcessor
{
    /**
     * @var array<string,array<string,string[]>>
     */
    private $fieldListMapCache = [];

    public function __construct(
        private EntityManager $entityManager,
        private UuidFactory $uuidFactory,
    ) {
    }

    /**
     * @param array<string,mixed> $options
     */
    public function process(Entity $entity, array $options): void
    {
        $fieldList = $this->getFieldList($entity->getEntityType());

        foreach ($fieldList as $version => $fieldNameList) {
            foreach ($fieldNameList as $fieldName) {
                $this->processItem($entity, $version, $fieldName, $options);
            }
        }
    }

    /**
     * @param array<string,mixed> $options
     */
    private function processItem(Entity $entity, string $version, string $fieldName, array $options): void
    {
        if (!empty($options['import'])) {
            if ($entity->has($fieldName)) {
                return;
            }
        }

        // Do not generate if uuid exists.
        if ($entity->get($fieldName)) {
            return;
        }

        $uuid = $this->uuidFactory->create($version);

        $entity->set($fieldName, $uuid->toString($entity));
    }

    /**
     * @return array<string,string[]>
     */
    private function getFieldList(string $entityType): array
    {
        if (array_key_exists($entityType, $this->fieldListMapCache)) {
            return $this->fieldListMapCache[$entityType];
        }

        $entityDefs = $this->entityManager
            ->getDefs()
            ->getEntity($entityType);

        $list = [];

        foreach ($entityDefs->getFieldNameList() as $name) {
            $defs = $entityDefs->getField($name);

            if ($defs->getType() !== 'uuid') {
                continue;
            }

            /** @var ?string $version */
            $version = $defs->getParam('uuidVersion');

            if (!$version) {
                continue;
            }

            $list[$version][] = $name;
        }

        $this->fieldListMapCache[$entityType] = $list;

        return $list;
    }
}
