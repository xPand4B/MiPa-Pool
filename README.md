# MiPa-Pool
![Build Status](https://github.com/xPand4B/MiPa-Pool/workflows/CI/badge.svg)

Eine Webanwendung, um Essensbestellungen in der Mittagspause zu verwalten und kommunizieren.

- **License**: MIT License
- **Github Repository**: <https://github.com/xPand4B/MiPa-Pool>
- **Issue Tracker**: <https://github.com/xPand4B/MiPa-Pool/issues>
- **Documentation**: <https://github.com/xPand4B/MiPa-Pool/tree/master/documentation>

# Table of Content
- [Versioning](#versioning)
- [How to install](#how-to-install)
    - [Settings](#settings)
    - [Console Commands](#console-commands)

# Versioning
The MiPaPo follows the [Semantic Versioning 2.0.0](https://semver.org/).
1. MAJOR version when you make incompatible API changes,
2. MINOR version when you add functionality in a backwards-compatible manner, and
3. PATCH version when you make backwards-compatible bug fixes.

Additional labels for pre-release and build metadata are available as extensions to the MAJOR.MINOR.PATCH format. 

# How to install
## Settings
To setup the application you need a file named `.psh.yaml.override` in your **root directory**.
After you have that go inside the `.psh.yaml`, copy all settings you wanna change and paste them inside the `.psh.yaml.override`.

**IMPORTANT:** You need to keep the original hierarchy!

(e.x. you wanna override a const, there has to be a `const:` at the beginning.)

**Example, if you want to override the database settings _(.psh.yaml.override)_:**
```yaml
const:
  DB_DATABASE: "MiPa-Pool"
  DB_USERNAME: "some-user"
  DB_PASSWORD: "some-password"
```

## Console commands
All available console commands _(Production and Development)_ can be found by typing `./psh.phar`.
To install you just type `./psh.phar install`.
