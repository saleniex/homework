***Task***

1. Refactor code in order to improve readability and effectivity;

2. Implement extra functionality so logging can be easily switched to console output;

3. Create PHPUnit tests (optional);

***Rules***

1. File index.php cannot be changed.

2. Changes should be done in Logger class (new classes can be created if needed);

3. Commit after each step.

***Usage***

For Logger run:
Run php -q index.php

For Tests run:\
./phpunit tests/LoggerTest.php

Switching to command line can be done by passing true as first parameter:\
$logger = Logger::get(true);

Or by calling:
$logger->setCLI(); //default = true.\
$logger->setCLI(false); //false - to disable.

Logger supports dynamically switching from CLI to file, e.g.:\
...\
$logger->logError("error"); //default - will write to file;\
$logger->setCLI(true);\
$logger->logError("error"); //will output to command line;\
$logger->setCLI(false);\
$logger->logSuccess("success"); //will write to file;
