# Outline icons for Laravel

Simple converter from [Outline icons](https://github.com/outline/outline-icons) to Laravel blade components

## Install

```shell
composer require loranger/outline-blade-icons
```

## Usage

Convert all available icons

```shell
php artisan icons:convert
```

And use them as blade component

```php
<x-outline.padlock class="w-6"></x-outline.padlock>
```