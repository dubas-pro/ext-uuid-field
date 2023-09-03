<?php
/**
 * This file is part of the Dubas UUID Field - EspoCRM extension.
 *
 * dubas s.c. - contact@dubas.pro
 * Copyright (C) 2021-2022 Arkadiy Asuratov, Emil Dubielecki
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

use Espo\Core\Container;
use Espo\Core\Utils\File\Manager as FileManager;

class BeforeInstall
{
    private Container $container;

    public function run(Container $container): void
    {
        $this->container = $container;
        $this->cleanupPaths();
        $this->clearCache();
    }

    /**
     * Clean up.
     */
    private function cleanupPaths(): void
    {
        $fileManager = $this->getFileManager();

        $pathList = [
            'application/Espo/Modules/DubasUuidField',
            'client/modules/dubas-uuid-field',
        ];

        foreach ($pathList as $path) {
            if ($fileManager->exists($path) && $fileManager->isDir($path)) {
                $fileManager->removeInDir($path, true);
            }
        }
    }

    private function getFileManager(): FileManager
    {
        /** @var FileManager $fileManager */
        $fileManager = $this->container->get('fileManager');

        return $fileManager;
    }

    private function clearCache(): void
    {
        try {
            /** @var \Espo\Core\DataManager $dataManager */
            $dataManager = $this->container->get('dataManager');
            $dataManager->clearCache();
        } catch (\Exception $e) {
        }
    }
}
