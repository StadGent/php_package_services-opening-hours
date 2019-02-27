# Changelog

All Notable changes to `gent/services-opening-hours` package.

## [Unreleased]

### Changed

* DMOH-49: Changed the base value objects to those of the digipolisgent/value
  package.
* DMOH-55: Changed the config object so it contains the required API key.
  The api endpoint has changed and requires from now on an API key.
  See API documentation for more info:
  https://developer.gent.be/docs/dataset?service_id=openingsuren_service

## [1.0.1]

### Fixed

* Fixed OpenDataURI Handler.

## [1.0.0]

### Added

* Added PHP 7.2 support.

## [0.2.0]

### Added

* DMOH-43: Added method to get a Service by its URI.
* DMOH-43: Added method to get a Service by its Vesta ID.

## [0.1.0]

Initial release providing API to get Services & Channels + access the opening
hours for a Channel.

### Added

* DMOH-3: Added the Service value object.
* DMOH-4: Added the Channel value object.
* DMOH-5: Added the ServiceCollection value object.
* DMOH-6: Added the ChannelCollection value object.
* DMOH-11 : Added the Value objects related to the OpenNow & OpeningHours data.
* DMOH-7 : Added the ServiceService to access available Services.
* DMOH-8 : Added the ChannelService to access available Channels.
* DMOH-12: Added the OpenNow & OpenNowHTML methods to the ChannelService.
* DMOH-13: Added the OpeningHoursDay & OpeningHoursDayHTML methods to the
  ChannelService.
* DMOH-14: Added the OpeningHoursWeek & OpeningHoursWeekHTML methods to the
  ChannelService.
* DMOH-15: Added the OpeningHoursMonth & OpeningHoursMonthHTML methods to the
  ChannelService.
* DMOH-16: Added the OpeningHoursYear & OpeningHoursYearHTML methods to the
  ChannelService.
* DMOH-17: Added the OpeningHoursPeriod & OpeningHoursPeriodHTML methods to the
  ChannelService.

[1.0.0]: https://github.com/StadGent/php_package_services-opening-hours/compare/0.2.0...1.0.0
[0.2.0]: https://github.com/StadGent/php_package_services-opening-hours/compare/0.1.0...0.2.0
[0.1.0]: https://github.com/StadGent/php_package_services-opening-hours/releases/tag/0.1.0
[Unreleased]: https://github.com/StadGent/php_package_services-opening-hours/compare/master...develop
