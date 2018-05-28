Galileo Prime Typer
===================

Betting application for fun purpose only.

Users
-----

Registration is pretty much open, so each player can register in this application. But the access to tournament is
restricted by administration. User can join to each tournament but until you will not accept it he will not able to
participate in it.

Tournaments
-----------

You can create as much tournaments as you want. Then you are allowed to control the access of user that want to join
into tournaments

Betting system
--------------

You can specify an event (for now just football event) and all users with access rights can put bet on this event.
Each bet can be changed one hour before the event begins (this time can be configured). When the betting phase is
completed you all participants will see the bet of all others.

After the event is completed the system calculates the points to provide per bet

Points calculation
------------------

Calculation can be done by many strategies currently the only one available is the `basic_strategy`:

### Basic strategy

- perfect score match - 3 points
- good result given - 1 point
- wrong result - 0 points

Installation
============

1) Installing the Standard Edition
----------------------------------

Clone repository from

> git@github.com:galileo/Typer.git

### Use Composer

Install all dependencies:

    composer install

2) Checking your System Configuration
-------------------------------------

Same as for Symfony.

3) Browsing the Admin Application
---------------------------------

There is just one place that is available for adminsitration

    http://example.com/admin/game

4) Installing assets
--------------------

To install assets you will need node environemnt with grunt installed. Just run:

    grunt install


5) Whats next?
--------------

You have any ideas please share it with github issue tracker.

Contribution is also very welcome.

ENJOY IT!


### Serialization bug

Change the method in `vendor/doctrine/orm/lib/Doctrine/ORM/Mapping/ClassMetadataInfo.php`

```php
    public function newInstance()
    {
        if ($this->_prototype === null) {
            if (PHP_VERSION_ID > 50429) {
                $this->_prototype = $this->reflClass->newInstanceWithoutConstructor();
            } else {
                $this->_prototype = unserialize(sprintf('O:%d:"%s":0:{}', strlen($this->name), $this->name));
            }
        }
        return clone $this->_prototype;
    }
```
