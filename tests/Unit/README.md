# Tests

This project is setup for php unit testing. To create your own unit tests just at a file to the Unit directory.
Make sure the file is named ...Test.php and all methods that will cover a test case start with test...().

The tests can be run with the following composer command.

```php

// With ahoy
ahoy composer run phpunit

// Without ahoy
docker-compose run -w /var/www/html php composer run phpunit

```
