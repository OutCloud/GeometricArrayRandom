# GeometricArrayRandom


This package can be used to get values of given array with given geometric probability

## Examples:
### 'Together' Input Mode

```php
$matrix = [
    [1, 0.1], // value, probablility
    [2, 0.1],
    [3, 0.1],
    [4, 0.3],
    [5, 0.2],
    [null, 0.2],
]; 

$generator = new GeometricArrayRandom($matrix);
$result = $generator->nextNValues(10);

// possible result: [4, null, 5, 1, null, 5, 5, 4, null, 4]
```
### 'Separately' Input Mode

```php
$matrix = [
    [1, 2, 3, 4, 5, null], // values
    [0.1, 0.1, 0.1, 0.3, 0.2, 0.2] // probabilities
]; 

$generator = new GeometricArrayRandom($matrix);
$result = $generator->nextNValues(10);

// possible result: [4, null, 5, 1, null, 5, 5, 4, null, 4]
```

## Additional info
 - Sum of probabilities in single matrix must always be equal 1.0 (Instead an exception will be thrown)
 - Probability is float value grater or equal 0 and lower or equal 1 (Instead an exception will be thrown)
 - Each value must always has probability assigned (Instead an exception will be thrown)
 
## Installation:
```bash
composer require outcloud\geometric-array-random
```



