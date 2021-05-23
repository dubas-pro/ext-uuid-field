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

namespace Espo\Modules\DubasUuidField\Classes\ConsoleCommands;

use Espo\Core\Console\Commands\Command;
use Espo\Core\Di;
use Throwable;

class UuidIndex implements
    Command,
    Di\ServiceFactoryAware,
    Di\MetadataAware
{
    use Di\ServiceFactorySetter;
    use Di\MetadataSetter;

    protected $ignoreScopeList = [
        'UuidManager',
    ];

    public function run(array $options, array $flagList): void
    {
        $scopeList = [];
        if (!empty($options['scope'])) {
            $scopeList = array_map('ucfirst', explode(',', $options['scope']));
        }

        $all = in_array('all', $flagList);
        if ($all) {
            if (!empty($scopeList)) {
                $this->out("You passed flag --all. Option --scope is being ignored.\n");
            }

            $scopeList = [];
        }

        $populateMode = in_array('populateMode', $flagList);

        if ($populateMode) {
            $this->out("This will generate UUIDs for all empty fields. Enter [Y] to continue.\n");
            $isConfirmed = $this->ask();
            $isConfirmed = trim($isConfirmed);
            if (strtolower($isConfirmed) !== 'y') {
                $this->out("Canceled.\n");
                return;
            }
        }

        if (!$all && empty($scopeList)) {
            $this->out("Please provide at least one option.\n\n");
            $this->out("php command.php uuid-index [--scope=SCOPE|-all] [--populate-mode]\n\n");
            $this->out("Options:\n");
            $this->out("--scope=SCOPE           Comma separated list of entity types.\n");
            $this->out("--all                   Select all entity types.\n");
            $this->out("--populate-mode         Generates UUIDs for all empty fields.\n");
            return;
        }

        $this->out("Building index... Do not close the terminal. This may take a while...\n");

        $service = $this->serviceFactory->create('UuidManager');
        try {
            $service->storeEntityUuids($scopeList, $populateMode);
        } catch (Throwable $e) {
            $this->out("\n");
            $this->out($e->getMessage() . "\n");
            return;
        }

        $this->out("Index has been built.\n");
    }

    protected function ask()
    {
        $input = fgets(\STDIN);

        return rtrim($input, "\n");
    }

    protected function out($string): void
    {
        fwrite(\STDOUT, $string);
    }
}
