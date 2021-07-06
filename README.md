# MiPa-Pool
![Build Status](https://github.com/xPand4B/MiPa-Pool/workflows/CI/badge.svg)

Eine Webanwendung, um Essensbestellungen in der Mittagspause zu verwalten und kommunizieren.

- **License**: MIT License
- **Github Repository**: <https://github.com/xPand4B/MiPa-Pool>
- **Issue Tracker**: <https://github.com/xPand4B/MiPa-Pool/issues>

## Table of Content
- [How to install](#how-to-install)
- [Testing](#testing)
- [Versioning](#versioning)

## How to install
The installation process is very simple and only contains **three steps**:
1. Copy the `.env.example` file to `.env` and enter your credentials _(like database and mail stuff)_.
2. Run this commands:
    ```bash
    php artisan install {--dev}
    ```
3. Have Fun!

That's it, congratulation! \(^-^)/

## Testing
```bash
composer test
#or
php artisan test
```

## Versioning
The MiPaPo follows the [Semantic Versioning 2.0.0](https://semver.org/).
1. MAJOR version when you make incompatible API changes,
2. MINOR version when you add functionality in a backwards-compatible manner, and
3. PATCH version when you make backwards-compatible bug fixes.

Additional labels for pre-release and build metadata are available as extensions to the MAJOR.MINOR.PATCH format.

## License
The MIT License (MIT). Please see the included [License File](LICENSE.md) for more information.
