# Cached Valuestore

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dutchcodingcompany/cached-valuestore.svg?style=flat-square)](https://packagist.org/packages/dutchcodingcompany/cached-valuestore)
[![Total Downloads](https://img.shields.io/packagist/dt/dutchcodingcompany/cached-valuestore.svg?style=flat-square)](https://packagist.org/packages/dutchcodingcompany/cached-valuestore)

Adds a cached version of `spatie/valuestore` and registers it to the service container.

## Installation

You can install the package via composer:

```bash
composer require dutchcodingcompany/cached-valuestore
```

## Events

Three events are triggered:
- `DutchCodingCompany\CachedValuestore\Events\PutIntoValuestore`, triggered by `put`, `prepend`, `push`, `offsetSet`, `increment` and `decrement`
- `DutchCodingCompany\CachedValuestore\Events\ForgetFromValuestore`, triggered by `forget`
- `DutchCodingCompany\CachedValuestore\Events\FlushValuestore`, triggered by `flush` and `flushStartingWith`

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.