# OpeningHours : Examples

This directory contains examples of how to access the OpeningHours API using
this package.

## Install

The examples require the `config.php` file being in place and filled in.

Copy the `config.example.php` file to `config.php` and fill in the values.
Do not alter the example scripts, all variables are defined in the `config.php`
file.

## Examples

### Service related

* `101-Service-GetAll.php` : Get all available services.
* `102-Service-SearchByLabel.php` : Search all services which label contains the
  given search string.
* `103-Service-GetById.php` : Get a single Service by its Id.

### Channel related

* `201-Channel-GetAll.php` : Get all channels related to a single service (by the
  service ID).
* `202-Channel-GetById.php` : Get a single Channel by the Service ID and the
  Channel ID.
* `211-Channel-OpenNow.php` : Get the Open Now status as object.
* `211-Channel-OpenNowHtml.php` : Get the Open Now status as HTML.
* `221-Channel-OpeningHoursDay.php` : Get the opening hours for a single day as
  object.
* `221-Channel-OpeningHoursDayHtml.php` : Get the opening hours for a single day
  as HTML.
* `222-Channel-OpeningHoursWeek.php` : Get the opening hours for a single week
  as object.
* `222-Channel-OpeningHoursWeekHtml.php` : Get the opening hours for a single
  week as HTML.
* `223-Channel-OpeningHoursMonth.php` : Get the opening hours for a single month
  as object.
* `223-Channel-OpeningHoursMonthHtml.php` : Get the opening hours for a single
  month as HTML.

## Usage

The scripts can only be called from command line.

Example:

```bash
php 01-Service-GetAll.php
```
