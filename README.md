# Gent Services : Opening Hours

[![Latest Stable Version][ico-version]][link-packagist]
[![Latest Unstable Version][ico-version-unstable]][link-packagist]
[![Total Downloads][ico-downloads]][link-packagist]
[![License][ico-license]][link-license]

[![Build Status][ico-travis]][link-travis]
[![Maintainability][ico-maintainability]][link-maintainability]
[![Test Coverage][ico-test-coverage]][link-test-coverage]
[![PHP 7 ready][ico-php7]][link-php7]

PHP package to access the Opening Hours API and wrap the responses in value
objects.

This package allows to consume the [Opening Hours Platform] API to lookup
services, their channels and their opening hours data.

See [OpeningHours API documentation][link-api-docs] about the endpoints and how
to get an API key to access the service.

## Install

Via Composer:

``` bash
composer require stadgent/services-opening-hours
```

## Usage

See the [code examples documentation](examples/README.md) included in this
package.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed
recently.

## Testing

Run all tests:

```bash
vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md)
and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email security [at] gent.be
instead of using the issue tracker. See [SECURITY](SECURITY.md)

## Credits

- [Stad Gent][link-author-stadgent]
- [Digipolis Gent][link-author-digipolisgent]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more
information.

## Roadmap and issue queue notes

This project is created and maintained by Digipolis Gent. During active
development, we use an internal issue tracker to guide/drive our development.
By working this way, we can link issues for other projects dependent on this
project, create cross-project boards, ... This allows our developers, project
leads and business analysts to have a better overview than we can create on
Github. This means that our roadmap won't be visible on here (for now).

We still look at the issue queue here and off course we welcome pull requests
with open arms! We are committed to creating and maintaining open source
projects. Questions about our approach can be asked through the issue queue
(except for security issues).

[ico-version]: https://img.shields.io/packagist/v/stadgent/services-opening-hours.svg?style=flat-square
[ico-version-unstable]: https://img.shields.io/packagist/vpre/stadgent/services-opening-hours.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/stadgent/services-opening-hours.svg?style=flat-square
[ico-license]: https://img.shields.io/github/license/StadGent/php_package_services-opening-hours.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/StadGent/php_package_services-opening-hours/master.svg?style=flat-square
[ico-maintainability]: https://img.shields.io/codeclimate/maintainability/StadGent/php_package_services-opening-hours.svg?style=flat-square
[ico-test-coverage]: https://img.shields.io/codeclimate/c/StadGent/php_package_services-opening-hours.svg?style=flat-square
[ico-php7]: https://php7ready.timesplinter.ch/StadGent/php_package_services-opening-hours/master/badge.svg

[link-packagist]: https://packagist.org/packages/stadgent/services-opening-hours
[link-license]: LICENSE.md
[link-travis]: https://travis-ci.org/StadGent/php_package_services-opening-hours
[link-maintainability]: https://codeclimate.com/github/StadGent/php_package_services-opening-hours/maintainability
[link-test-coverage]: https://codeclimate.com/github/StadGent/php_package_services-opening-hours/test_coverage
[link-php7]: https://travis-ci.org/StadGent/php_package_services-opening-hours
[link-author-stadgent]: https://github.com/stadgent
[link-author-digipolisgent]: https://github.com/digipolisgent
[link-contributors]: ../../contributors

[Opening Hours platform]: https://github.com/StadGent/laravel_site_opening-hours
[link-api-docs]: https://developer.gent.be/docs/dataset?service_id=openingsuren_service
