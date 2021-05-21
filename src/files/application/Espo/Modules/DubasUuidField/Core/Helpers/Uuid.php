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
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 *
 */

namespace Espo\Modules\DubasUuidField\Core\Helpers;

use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    private \Espo\Core\Container $container;

    public function __construct(\Espo\Core\Container $container)
    {
        $this->container = $container;
    }

    public function getByVersion($version)
    {
        $version = (int) $version;

        switch ($version) {
            case 1:
                $uuid = $this->uuid1();
                break;
            case 4:
                $uuid = $this->uuid4();
                break;
            default:
                $uuid = '';
                break;
        }

        return $uuid;
    }

    public function uuid1()
    {
        $uuid = RamseyUuid::uuid1();

        return $uuid->toString();
    }

    public function uuid4()
    {
        $uuid = RamseyUuid::uuid4();

        return $uuid->toString();
    }

    protected function getContainer()
    {
        return $this->container;
    }
}
