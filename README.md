#MattCannon\TypedCollections

This is an extension of Laravel's Illuminate\Support\Collection,
which can be type restricted.
 
##Current Status

* todo

##Requirements

* PHP 5.6+

##Installation

###Composer

To install this package using composer, run: 

`composer require matt-cannon/typed-collections:*`

##Usage
To create an untyped collection, you can use:

```php
<?php
$collection = MattCannon\Collections\UntypedCollection::make([]);
```

To create a typed collection, you can use

```php
<?php
$collection = MattCannon\Collections\UntypedCollection::makeWithType([],'string');
$collection = MattCannon\Collections\UntypedCollection::makeWithType([],'integer');
$collection = MattCannon\Collections\UntypedCollection::makeWithType([],'stdClass');
$collection = MattCannon\Collections\UntypedCollection::makeWithType([],'\Namespace\CustomClass');
```
