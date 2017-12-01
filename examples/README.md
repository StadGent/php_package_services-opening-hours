# OpeningHours : Examples
This directory contains examples of how to access the OpeningHours API using
this package.

## Install

The examples require the `config.php` file being in place and filled in.

Copy the `config.example.php` file to `config.php` and fill in the values.
Do not alter the example scripts, all variables are defined in the `config.php`
file. 

## Examples

* `01-Service-GetAll.php` : Get all available services.
* `02-Service-SearchByLabel.php` : Search all services which label contains the 
  given search string.
* `03-Service-GetById.php` : Get a single Service by its Id.

# Usage

The scripts can only be called from command line.

Example:

```bash
php 01-Service-GetAll.php
```
