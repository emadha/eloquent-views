# Laravel Eloquent Views 
<p align="center">
<a href="https://packagist.org/packages/emadha/eloquent-views"><img src="https://poser.pugx.org/emadha/eloquent-views/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/emadha/eloquent-views"><img src="https://poser.pugx.org/emadha/eloquent-views/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/emadha/eloquent-views"><img src="https://poser.pugx.org/emadha/eloquent-views/license.svg" alt="License"></a>
</p>
A Composer Package to add views to eloquent models

## Requirements

This package requires Laravel 5.8 or higher, PHP 7.2 or higher and a database that supports `json` fields and MySQL compatible functions.

## Installation

You can install the package via composer:

``` bash
composer require emadha/eloquent-views
```

The package will automatically register itself.

You can publish the config with:

``` bash
php artisan vendor:publish --provider="EmadHa\EloquentViews\ServiceProvider" --tag="config"
```

## Usage
Adding `HasEloquentViews` trait to your **eloquent** models is all you need to start using this package.

The views directory structure is like this: `resources/views/eloquent/{model}/{view}` where *eloquent* is defined in the config file and *model* is your lowercase model class e.g. `post` and the *view* is the view you request to render.

Example:

```php

# Render a single model view
Post::first()->render('block'); // Single block, rendered.

# Build views for a colletion of models
# This will return a collection object.
Post::all()->render('block');

# You can use 'implode' to get this as a single html string e.g. ...->implode(null);
Post::all()->render('block')->implode(null);
```
This code will look into `/resources/views/eloquent/post/block.blade.php` and render it.

- The Data will be passed to the view through `$model` variable.
- You can pass an array in the `render` method after the first argument `Post::first()->render('block', ['moredata'=>'Yes!]);`

You can access that data like how you normally would, from a view:

```blade
<!-- /resources/views/eloquent/post/block.blade.php -->
<h1> {{ $model->title }} </h1>
<p> {{ $moredata }} </p>
``` 


## The Beauty of it

How about you use this instead of including or creating the same code all the time ?
```blade
<!-- welcome.blade.php -->

<div class="news-items">
   {!! App\NewsItem::all()->render('block')->implode(null) !!}
</div>
```

And not just that, imagine if you want to have the rendered view output in your controller, for example and api, or search controller, where you want to get the output? This will make this side of project as simple as it can be!

## Thank you. 