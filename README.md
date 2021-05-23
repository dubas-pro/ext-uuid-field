# Dubas UUID Field for EspoCRM

[![GitHub release (latest by date)](https://img.shields.io/github/v/release/dubas-pro/ext-uuid-field)](https://devcrm.it/uuid)
[![EspoCRM](https://img.shields.io/badge/espocrm-%3E%3D6.1.0-blue)](#dubas-uuid-field-for-espocrm)
[![PHP](https://img.shields.io/badge/php-%3E%3D7.3-blue)](#dubas-uuid-field-for-espocrm)
[![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)

The EspoCRM extension for generating universally unique identifiers (UUIDs).

## Supported UUID versions

- [Version 1: Time-based](https://uuid.ramsey.dev/en/latest/rfc4122/version1.html#rfc4122-version1)
- [Version 4: Random](https://uuid.ramsey.dev/en/latest/rfc4122/version4.html#rfc4122-version4)

## Screenshot

[![Screenshot of Dubas UUID field for EspoCRM](https://devcrm.it/files/2020-12-13_01-20-31_6df171-uF-779948_65b07ac0379e20.png)](#screenshot)

## Requirements

- EspoCRM 6.1.0 or later;
- PHP 7.3 or later;

### Optional PHP extensions

While not required, these extensions improve the performance of ramsey/uuid.

- [ext-ctype](https://www.php.net/manual/en/book.ctype.php)
- [ext-gmp](https://www.php.net/manual/en/book.gmp.php)
- [ext-bcmath](https://www.php.net/manual/en/book.bc.php)

## Getting started

### Installing an extension

You can download the extension from https://devcrm.it/uuid as a zip file.

Instructions for installing EspoCRM Extensions can be found in the [official documentation](https://docs.espocrm.com/administration/extensions/#installing).

### Creating UUID field

Use Entity Manager in EspoCRM Administration panel to create new field for given entity types. For more information please consult the [official documentation](https://docs.espocrm.com/administration/entity-manager/).

## Bugs

If you find an issue, let us know [here](https://github.com/dubas-pro/ext-uuid-field/issues/new)!

## Support

This repository is not suitable for support. Please don't use our issue tracker for support requests, but for core issues only.

**Need help?** Please write us an email at <a href="mailto:contact@dubas.pro">contact@dubas.pro</a> or visit [https://devcrm.it](https://devcrm.it).

Support requests in issues on this repository will be closed on sight.

## License

DUBAS S.C. - contact@dubas.pro

Copyright (C) 2021 Arkadiy Asuratov, Emil Dubielecki

Dubas UUID Field extension for EspoCRM is published under the [GNU GPLv3](https://www.gnu.org/licenses/gpl-3.0.html).
