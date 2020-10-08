# Create a static site bundle from a Laravel app

[![Latest Version on Packagist](https://img.shields.io/packagist/v/spatie/laravel-export.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-export)
[![Build Status](https://img.shields.io/travis/spatie/laravel-export/master.svg?style=flat-square)](https://travis-ci.org/spatie/laravel-export)
[![StyleCI](https://github.styleci.io/repos/176365605/shield?branch=master)](https://github.styleci.io/repos/176365605)
[![Quality Score](https://img.shields.io/scrutinizer/g/spatie/laravel-export.svg?style=flat-square)](https://scrutinizer-ci.com/g/spatie/laravel-export)
[![Total Downloads](https://img.shields.io/packagist/dt/spatie/laravel-export.svg?style=flat-square)](https://packagist.org/packages/spatie/laravel-export)

```
$ php artisan export
Exporting site...
Files were saved to disk `export`
```

Build your blog or site with Laravel like with the tools you're used to having and export it to be hosted statically.

Laravel Export will scan your app and create an HTML page from every URL it crawls. The entire `public` directory also gets added to the bundle so your assets are in place too.

A few example use cases for this package:

- Build your own blog or site in Laravel with all the tools you're used to using. Export a static version and just upload it anywhere for hosting, no need for managing a full-blown server anymore.

- Use something like [Nova](https://nova.laravel.com/), [Wink](https://wink.themsaid.com/), or any other admin panel to manage your site locally or on a remote server, then publish it to a service like Netlify. This gives you all benefits of a static site (speed, simple hosting, scalability) while still having a dynamic backend of some sort.

## Installation

You can install the package via composer:

```bash
composer require spatie/laravel-export
```

After the package is installed, you can optionally publish the config file.

```bash
php artisan vendor:publish ...
```

## Configuration

Laravel Export doesn't require configuration to get started, but there are a few things you can tweak to your needs.

```php
// config/export.php

return [
    'disk' => 'export',
];
```

This means you can also use other filesystem drivers, so you could export your site straight to something like S3.

### Determining the export contents

#### Crawling

With the default configuration, Laravel Export will crawl your site and export every page to a static site. If you'd like to disable this behaviour, disable the `crawl` option.

```php
return [
    'crawl' => true,
];
```

#### Paths

`paths` is an array of URL paths that will be exported to HTML. Use this to manually determine which pages should be exported.

```php
return [
    'paths' => [
        '/',
        '/rss.xml',
    ],
];
```

#### Including files

`include_files` allows you to specify files and folders relative to the application root that should be added to the export. By default, we'll include the entire `public` folder.

```php
return [
    'include_files' => [
        'public' => '',
    ],
];
```

`exclude_file_patterns` will check all source paths of included files, and exclude them if they match a pattern from in `exclude_file_patterns`. By default, all PHP files will be excluded, mainly to stop `index.php` from appearing in your export.

```php
return [
    'exclude_file_patterns' => [
        '/\.php$/',
    ],
];
```

#### Configuration through code

All configuration options that affect the exports contents are also exposed in the `Exporter` class. You can inject this class to modify the export settings through code.

```php
use Illuminate\Support\ServiceProvider;
use Spatie\Export\Exporter;

class AppServiceProvider extends ServiceProvider
{
    public function boot(Exporter $exporter)
    {
        $exporter->crawl(false);

        $exporter->paths(['', 'about', 'contact', 'posts']);
        $exporter->paths(Post::all()->pluck('slug'));
    }
}
```

### Custom disks

By default, Laravel Export will save the static bundle in a `dist` folder in your application root. If you want to store the site in a different folder, [configure a new disk](https://laravel.com/docs/5.8/filesystem) in `config/filesystem.php`.

```php
// config/filesystem.php

return [
    'disks' => [
        //

        'export' => [
            'driver' => 'local',
            'root' => base_path('out'),
        ],
    ],
];
```

### Hooks

`before` and `after` hooks allow you to do things before or after an export. Hooks can contain any shell command.

The default configuration doesn't have any hooks configured, but shows two examples.

With this `before` hook, we'll use Yarn to build our assets before every export:

```php
return [
    'before' => [
        'assets' => '/usr/local/bin/yarn production',
    ],
];
```

With this `after` hook, we'll deploy the static bundle to Netlify with their [CLI tool](https://www.netlify.com/docs/cli/) after the export.

```php
return [
    'after' => [
        'deploy' => '/usr/local/bin/netlify deploy --prod',
    ],
];
```

If you want to run an export without certain hooks, use `--skip-{hook}` flags.

```bash
php artisan export --skip-deploy
```

## Usage

To build a bundle, run the `export` command:

```
php artisan export
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email freek@spatie.be instead of using the issue tracker.

## Postcardware

You're free to use this package, but if it makes it to your production environment we highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using.

Our address is: Spatie, Samberstraat 69D, 2060 Antwerp, Belgium.

We publish all received postcards [on our company website](https://spatie.be/en/opensource/postcards).

## Credits

- [Sebastian De Deyne](https://github.com/sebastiandedeyne)
- [All Contributors](../../contributors)

## Support us

Spatie is a webdesign agency based in Antwerp, Belgium. You'll find an overview of all our open source projects [on our website](https://spatie.be/opensource).

Does your business depend on our contributions? Reach out and support us on [Patreon](https://www.patreon.com/spatie).
All pledges will be dedicated to allocating workforce on maintenance and new awesome stuff.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
