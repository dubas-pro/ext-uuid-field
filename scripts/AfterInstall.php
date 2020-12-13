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

class AfterInstall
{
    protected $container;

    public function run($container)
    {
        $this->container = $container;
    }

    protected function clearCache()
    {
        try {
            $this->container->get('dataManager')->clearCache();
        } catch (\Exception $e) {
        }
    }
}
