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

namespace Espo\Modules\DubasUuidField\Core\Utils;

use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    public function generateByVersion(string $version): string
    {
        $methodName = 'uuid' . $version;
        if (\method_exists($this, $methodName)) {
            return $this->$methodName();
        }

        return '';
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
