STL PHP
=======

This repository contains code for handling 3D models saved in STL format.

##How to get it

The suggested installation method is via [composer](https://getcomposer.org/). 
Add a dependency on `chubv/stl-php` to your project's `composer.json` file.

##Usage

To get the model build the `Reader` and read the model from file

`$model = STLReader::forFile(__DIR__ . '/stls/text.stl')->readModel();`

You can use `VolumeHandler` to calculate volume of 3D model without `STLModel` object construction 
(memory consumption is proportional to model size) 
or write your own handler by implementing `HandlerInterface` and setting it to reader.

```php
    $reader = STLReader::forFile(__DIR__ . '/stls/text.stl');
    $reader->setHandler(new VolumeHandler());
    $volume = $reader->readModel();
```

##Tests

The PHPUnit version to be used is the one installed as a dev- dependency via composer:

```sh
$ ./vendor/bin/phpunit
```

##License

It's under MIT. Look at LICENSE file.

##Contributing

Feel free to make pull requests or create issues. You can also contact me via e-mail v[at]chub.com.ua