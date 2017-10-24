# Imager

[![Build Status](https://travis-ci.org/sc0Vu/Imager.svg?branch=master)](https://travis-ci.org/sc0Vu/Imager)
[![codecov](https://codecov.io/gh/sc0Vu/Imager/branch/master/graph/badge.svg)](https://codecov.io/gh/sc0Vu/Imager)
[![License](https://poser.pugx.org/guancheng/imager/license)](https://packagist.org/packages/guancheng/imager)

Image library for php.

# Install
```
composer require guancheng/imager
```

# Usage
```
use LGC\Imager\Imager;

$imager = new Imager([
    'library' => 'gd' // library gd | im
    'fileInfo' => [
        'src' => 'test.jpg',
        'type' => 'jpg'
    ]
]);
$imager->compress(80);
$imager->run();
```

# Test
```
vendor/bin/phpunit
```

# Licence

MIT