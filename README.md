# WinegramAnalisisBundle

A Symfony3 bundle ...


## Installation

Add and require the bundle repository in your Symfony application's `composer.json`.

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/aaidettaa/WinegramAnalisisBundle.git
    }
],
"require": {
    "aaidettaa/WinegramAnalisisBundle": "dev-master"
},
```

Update your dependencies.

```shell
$ composer update
```


## Configuration

First, enable the bundle in the `app/AppKernel.php` file.


```php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new WinegramAnalisisBundle\WinegramAnalisisBundle(),
        );

        // ...
    }

    // ...
}
```