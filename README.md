# Adobe Scene7 HTTP Protocol API #
A library to create request strings for the Adobe Scene7 HTTP Protocol.

### Factory Defaults Callback ##
I decided that instead of trying to implement a defaults setter using an array or an object or something else, I would
use a callback. This allows you to do a lot more than with another method.

```php
$callback = function (AbstractRequest $request) {
    switch ($request->getRequestType) {
        case 'image':
            $request
                ->setDefaultImage('MyDefaultImage')
                ->setId(rand(0,100));
            break;
    }
}
```

## Helpers ##

### Picture ###
You can quickly create a picture tag with nested <source> and <img> tags.

The easiest way to create a picture tag is using `Picture::addSourceListFromImage()`.

#### Example ####
```php
$picture = new Picture;
$image = new \Scene7\Requests\Image('https://example.com/', 'myProduct');
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