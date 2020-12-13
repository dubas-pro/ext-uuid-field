<?php

/*
 * This file is part of the DUBAS UUID Field package.
 *
 * (c) DUBAS - Emil Dubielecki & Arkadiy Asuratov S.C.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 * Under the terms of the license, You shall not sublicense, resell, rent, lease, distribute,
 * or otherwise transfer rights or usage to the software.
 */

namespace Espo\Modules\DubasUuidField\Core\Helpers;

use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    private $container;

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
