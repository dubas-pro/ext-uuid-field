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

namespace Espo\Modules\DubasUuidField\Core\Helpers;

use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    public function getByVersion(string $version): string
    {
        switch ($version) {
            case '1':
                $uuid = $this->uuid1();
                break;
            case '4':
                $uuid = $this->uuid4();
                break;
            default:
                $uuid = '';
                break;
        }

        return $uuid;
    }

    public function uuid1(): string
    {
        $uuid = RamseyUuid::uuid1();

        return $uuid->toString();
    }

    public function uuid4(): string
    {
        $uuid = RamseyUuid::uuid4();

        return $uuid->toString();
    }
}
