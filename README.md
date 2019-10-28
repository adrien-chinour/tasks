![travisCI Build](https://travis-ci.org/adrien-chinour/todo-command-app.svg?branch=master)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=adrien-chinour_todo-command-app&metric=alert_status)](https://sonarcloud.io/dashboard?id=adrien-chinour_todo-command-app)
# Todo Command Line Application

## Requirement

- PHP 7.3
- Extension PHP PDO
- Composer

## Installation

### From source file
```
git clone https://github.com/adrien-chinour/todo-command-app
cd todo-command-app
composer install
```

### From composer
```bash
composer require chinour/task-manager
```

## Tests

```bash
# Run unit tests
composer test

# Run unit tests with code coverage
composer coverage
```
