# Connect Core Bundle for Contao Open Source CMS

This bundle adds functionality to manage projects, todos and time to the Contao Open Source Content Management System.

## Attention

This bundle is currently under development. You can use it on your own risk! A stable version will be available soon. Of course you can submit issues and feature requests on the repository issue section. Thx! 

## Installation

### contao/standard-edition

Run in your project folder the following composer command to add the Connect Bundle to your project.

```
    ./composer require wr/connect-core-bundle
```

Add the Bundle to app/AppKernel.php bundles array after all the contao bundles.

```php
public function registerBundles()
    {
        $bundles = [
            .....    
            new Wr\Connect\CoreBundle\ConnectCoreBundle() //Add this line.
        ];

        ....
        
        return $bundles;
    }
```

Clear the chache and warmup the cache with the follwing two commands.

``` 
    ./bin/console cache:clear --no-warmup --env=prod
    ./bin/console cache:warmup  --env=prod
```

Go to the install tool and update the database and then login in the to backend.

### contao-managed-edition

**Without the awesome Contao Manger**

Run in your project folder the following composer command to add the Connect Bundle to your project.

```
    composer require wr/connect-core-bundle
```

Clear the chache and warmup the cache with the follwing two commands.

``` 
    ./bin/console cache:clear --no-warmup --env=prod
    ./bin/console cache:warmup  --env=prod
```

Go to the install tool and update the database and then login in the to backend.

**With the awesome Contao Manger**

1. Search in the Contao Manager search bar the bundle wr/connect-core-bundle and click on the install button.
2. Go to the install tool and update the database and then login in the to backend.


## Dependencies

- php ^7.0
- symfony/symfony
- contao/core-bundle
- doctrine/orm

## Licence

The Connect Core Bundle is published under the LGPLv3

## Documentation

Unfortunately at the moment there is no documentation available. But we will fix this as soon as there is a stable version.
 
 ## Contact
 
 For further information feel free and get in contact with us. mail@webrealisierung.ch
 
 ## Donation
 
 If you like our work feel free to donate.
 
 There are many ways to donate to the project. The following list contains some possibilities.
 
 - Constribute your code over pull requests.
 - Test, test, test and feedback.
 - Submit features or issues.
 - Tell us a joke.
 - [![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=EHB7BYWLMPV7Y) You know that every coffee counts while coding:-)


