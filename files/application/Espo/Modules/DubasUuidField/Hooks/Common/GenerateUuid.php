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

namespace Espo\Modules\DubasUuidField\Hooks\Common;

use Espo\ORM\Entity;

class GenerateUuid extends \Espo\Core\Hooks\Base
{
    public static $order = 9;

    public function beforeSave(Entity $entity, array $options = [])
    {
        $uuidHelper = $this->getContainer()->get('uuidHelper');
        $fieldDefs = $this->getMetadata()->get(['entityDefs', $entity->getEntityType(), 'fields'], []);

        foreach ($fieldDefs as $fieldName => $defs) {
            if (isset($defs['type']) && $defs['type'] === 'uuid') {
                if (!empty($options['import'])) {
                    if ($entity->has($fieldName)) {
                        continue;
                    }
                }

                if ($entity->get($fieldName)) {
                    continue;
                }

                $uuidVersion = $this->getMetadata()->get(['entityDefs', $entity->getEntityType(), 'fields', $fieldName, 'uuidVersion'], '1');

                $uuid = $uuidHelper->getByVersion($uuidVersion);
                if ('' !== $uuid) {
                    $entity->set($fieldName, $uuid);
                }
            }
        }
    }

    protected function init()
    {
        $this->addDependency('metadata');
    }

    protected function getMetadata()
    {
        return $this->getInjection('metadata');
    }
}
