# Pirates!

This is a PHP code example to showcase how an application could be structured.
This demo makes assumptions how the data should be handled and interpreted and is only designed for command line usage.
For the sake of possible future adaptions this demo only provides one test.

## The idea

We have N pirates, all entering an island from one side with their ship.
The island is N x N big, with every position containing a coin.

The pirates search the island for coins, when they find one coin they return to their ship.
The pirates pick up any coins along the way.

When a pirate meets other pirates they fight over who gets all coins.

The game continues until all the coins are on the ships.

## How to use

Run the following command in your terminal to set up the application.

```
composer install
```

Run the following command in your terminal to run the application.

```
php bin/run-hunt.php
```

### Run Tests

Run the following command in your terminal.

```
vendor/bin/phpunit tests
```
