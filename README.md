***Task***

1. Refactor code in order to improve readability and effectivity;

2. Implement extra functionality so logging can be easily switched to console output;

3. Create PHPUnit tests (optional);

***Rules***

1. File index.php cannot be changed.

2. Changes should be done in Logger class (new classes can be created if needed);

3. Commit after each step.

***Set up***

To set up, run
```
composer install
```

***Testing***

You can run the following script as shorthand for executing tests with 'php vendor/phpunit/phpunit/phpunit'
```
./phpunit.sh
```

***Run***
To run change logger to console, run
```
Logger=console php index.php
```