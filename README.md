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
$result = $generator->nextNValues(10);  // possible result: [4, null, 5, 1, null, 5, 5, 4, null, 4]
$singleValue = $generator->nextValue(); // possible result : 4
```
### 'Separately' Input Mode

```php
$matrix = [
    [1, 2, 3, 4, 5, null], // values
    [0.1, 0.1, 0.1, 0.3, 0.2, 0.2] // probabilities
]; 

$generator = new GeometricArrayRandom($matrix, GeometricArrayRandom::MODE_TWO_DIMENSIONS);
$result = $generator->nextNValues(10);  // possible result: [4, null, 5, 1, null, 5, 5, 4, null, 4]
$singleValue = $generator->nextValue(); // possible result : 4
```

## Additional info
 - Sum of probabilities in single matrix must always be equal to 1.0 (Otherwise an exception will be thrown)
 - Probability is 'float' value greater or equal to 0 and lower or equal to 1 (Otherwise an exception will be thrown)
 - Each value must always have a probability assigned (Otherwise an exception will be thrown)
 
## Installation:
```bash
composer require outcloud\geometric-array-random
```


I'm using Semanting Versioning http://semver.org/



