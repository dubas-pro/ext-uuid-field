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

namespace Espo\Modules\DubasUuidField\Services;

use StdClass;

class UuidManager extends \Espo\Services\Record
{
    protected $ignoreScopeList = [
        'UuidManager',
    ];

    public function storeEntityUuids(array $scopeList = [], bool $populateMode = false): void
    {
        $scopesFieldList = $this->getHavingUuidEntityTypeList($scopeList);
        foreach ($scopesFieldList as $scope => $fieldDefs) {
            $query = $this->entityManager->getQueryBuilder()
                ->select()
                ->from($scope)
                ->select(array_merge(['id'], array_keys($fieldDefs)))
                ->build();

            $sth = $this->entityManager->getQueryExecutor()->execute($query);
            while ($row = $sth->fetch(\PDO::FETCH_ASSOC)) {
                foreach ($row as $k => $v) {
                    if ($k === 'id') {
                        continue;
                    }
                    if (empty($v) && !$populateMode) {
                        continue;
                    }

                    $parent = $this->getEntityManager()->getEntity($scope, $row['id']);
                    if ($parent) {
                        $uuidManager = $this->getEntityManager()->getRepository('UuidManager')->storeEntityUuid($parent, $k);

                        if ($populateMode && $parent->hasAttribute($k)) {
                            $parent->set($k, $uuidManager->get('name'));
                            $this->getEntityManager()->saveEntity($parent, [
                                'skipAll' => true,
                                'silent' => true,
                                'skipHooks' => true,
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function jobRunUuidIndex(StdClass $data): void
    {
        $scopeList = $data->scopeList ?? [];
        $populateMode = $data->populateMode ?? false;

        $this->storeEntityUuids($scopeList, $populateMode);
    }

    protected function getHavingUuidEntityTypeList(array $scopeList = []): array
    {
        if (empty($scopeList)) {
            foreach ($this->metadata->get('scopes') as $scope => $data) {
                $isEntity = $data['entity'] ?? false;
                if (!$isEntity) {
                    continue;
                }
                if (in_array($scope, $this->ignoreScopeList, true)) {
                    continue;
                }

                $scopeList[] = $scope;
            }
        }

        $fieldList = [];
        foreach ($scopeList as $scope) {
            $fieldDefs = $this->metadata->get(['entityDefs', $scope, 'fields']);
            foreach ($fieldDefs as $field => $fieldParams) {
                if ($fieldParams['type'] === 'uuid') {
                    $fieldList[$scope][$field] = $fieldParams;
                }
            }
        }

        return $fieldList;
    }
}
