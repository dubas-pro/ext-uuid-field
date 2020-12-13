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

namespace Espo\Modules\DubasUuidField\Loaders;

class UuidHelper extends \Espo\Core\Loaders\Base
{
    public function load()
    {
        return new \Espo\Modules\DubasUuidField\Core\Helpers\Uuid($this->getContainer());
    }
}
