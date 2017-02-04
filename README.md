

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