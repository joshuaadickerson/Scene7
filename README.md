# Adobe Scene7 HTTP Protocol API #
A library to create request strings for the Adobe Scene7 HTTP Protocol.

## Installation ##
The easiest way to install this library is with Composer
`composer require joshuaadickerson/scene7`

There is no version yet since I'm not ready to call it stable.

The minimum PHP version is 5.6.

[![Build Status](https://travis-ci.org/joshuaadickerson/Scene7.svg?branch=master)](https://travis-ci.org/joshuaadickerson/Scene7)

## Factory ##
The factory should be used to create a new request and layers.

```php
// See "Factory Defaults Callback"
$factory = new Scene7\Factory('https://www.example.com', $callback);
$image = $factory->newImage('myProductImage');
echo $image->render();

// Output:
// https://www.example.com/myProductImage?defaultImage=MyDefaultImage&id=42
```

All requests and helpers also implement __toString() so you don't have to call render() directly.

### Factory Defaults Callback ##
I decided that instead of trying to implement a defaults setter using an array or an object or something else, I would
use a callback. This allows you to do a lot more than with another method.

```php
$callback = function (AbstractRequest $request) {
    // Apply defaults based on the request type
    switch ($request->getRequestType()) {
        case 'img':
            $request
                ->setDefaultImage('MyDefaultImage')
                ->setId(rand(0, 100));
            break;
    }
}
```

You can set the layer defaults the same as well. They will only be applied when you add a new layer.

## Helpers ##

### Picture ###
You can quickly create a picture tag with nested <source> and <img> tags.

The easiest way to create a picture tag is using `Picture::addSourceListFromImage()`.

#### Example ####
```php
$picture = new Scene7\Helpers\Html\Picture;
$image = new Scene7\Requests\Image('https://example.com/', 'myProduct');
$queries = [
    // The key is the media query
    // The value is an array of k/v pairs where the key is the HTML attribute you want to set
    '(min-width: 1000px)' => [
        // Width and height get multiplied based on $multipliers (see below)
        'width' => 500,
        'height' => 500,
    ],
    '(min-width: 500px)' => [
        'width' => 250,
        'height' => 250,
    ],
];
$picture->addSourceListFromImage($queries, $image, [2, 1])->setImage($image);

echo $picture->render();

// Output:
// <picture><source media="(min-width: 1000px)" srcset="https://example.com/myProduct?wid=1000&hei=1000 2x,https://example.com/myProduct?wid=500&hei=500 1x,"><source media="(min-width: 500px)" srcset="https://example.com/myProduct?wid=500&hei=500 2x,https://example.com/myProduct?wid=250&hei=250 1x,"><img src="https://example.com/myProduct?" alt=""></picture>
```

## Contributing ##
This _is_ maintained. I don't want to give the impression that it's not. I plan on doing some things with this and I use
it at work. One of the big reasons for open sourcing it though, is so I don't have to do _all_ of the work.

Feel free to submit pull requests. Please add tests with your PR so I can merge it faster.

If you have a feature request or issue, I consider that a contribution and welcome them.

### TODO ###
* implement all of the request types
* test everything
* figure out the "src" command documentation
* implement mask
* more helpers like audio and video
* documentation
* examples
* fix obscured queries
* add Travis CI config
* add some cool things to this readme to show if it's successfully building and the test coverage


## License ##
This work is licensed under the BSD-3 clause license