# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2021-05-24

### Added
- UUIDs Manager to keep track of all UUIDs stored in the system. Available from Administration > Data > UUIDs.
- Helper console command for indexing UUIDs and generating UUIDs for newly created fields.
  ```
  php command.php uuid-index [--scope=SCOPE|-all] [--populate-mode]

  Options:
  --scope=SCOPE           Comma separated list of entity types.
  --all                   Select all entity types.
  --populate-mode         Generates UUIDs for all empty fields.
  ```
- This CHANGELOG file.
- Uploaded [full source code](https://github.com/dubas-pro/ext-uuid-field) used to compile the extension.

### Changed
- Minimum EspoCRM requirement to 6.1.0.
- Minimum PHP requirement to 7.3.
- Updated README file.
- Changed field type name from "Dubas UUID" to just "UUID" in Entity Manager.

### Fixed
- Incorrect (propriety!) license header in source files. GPL-licensed components is also free and is licensed under the GPL.

## [0.0.2] - 2021-01-31

### Changed
- Minimum EspoCRM requirement to 6.0.9.

### Fixed
- Compatibility for EspoCRM 6.0.9 or later.

## [0.0.1] - 2020-12-01

### Added
- First release.

[1.0.0]: https://github.com/dubas-pro/ext-uuid-field/compare/0.0.2...1.0.0
[0.0.2]: https://github.com/dubas-pro/ext-uuid-field/compare/0.0.1...0.0.2
[0.0.1]: https://github.com/dubas-pro/ext-uuid-field/releases/tag/0.0.1
