***Task***

1. Refactor code in order to improve readability and effectivity;

2. Implement extra functionality so logging can be easily switched to console output;

3. Create PHPUnit tests (optional);

***Rules***

1. File index.php cannot be changed.

2. Changes should be done in Logger class (new classes can be created if needed);

3. Commit after each step.

***Usage***

To turn on console output:
```bash
$ php index.php --console
```

To run tests:
```bash
$ composer install
```

```bash
$ ./vendor/bin/phpunit --testdox
```