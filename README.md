# visitor

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This package provides a visitor pattern implementation.

## Visitor Pattern

Visitor is a behavioral design pattern that lets you separate algorithms from the objects on which they operate.


## Install

Via Composer

``` bash
$ composer require thrashzone13/visitor
```

## Usage

Consider having an array of different kinds of shapes
``` php
$shapes = [
    new Circle(radius: 10),
    new Rectangle(width: 15, height: 20),
    new Rectangle(width: 10, height: 14),
    new Square(side: 16)
];
```
Let's say the intention is to calculate their area and sum them up. There can be a visitor which does the calculation regarding the type of the received instance
``` php
$visitor = (new Visitor)
    ->add(fn(Circle $circle) => pi() * $circle->getRadius() * $circle->getRadius())
    ->add(fn(Square $square) => $square->getSide() * $square->getSide())
    ->add(fn(Rectangle $rectangle) => $rectangle->getWidth() * $rectangle->getHeight());
```
Now it's ready to use!
``` php
$totalArea = 0;
foreach ($shapes as $shape) {
    $totalArea += $visitor->visit($circle);
}
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/thrashzone13/visitor.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/thrashzone13/visitor/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/thrashzone13/visitor.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/thrashzone13/visitor.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/thrashzone13/visitor.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/thrashzone13/visitor
[link-travis]: https://travis-ci.org/thrashzone13/visitor
[link-scrutinizer]: https://scrutinizer-ci.com/g/thrashzone13/visitor/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/thrashzone13/visitor
[link-downloads]: https://packagist.org/packages/thrashzone13/visitor
[link-author]: https://github.com/thrashzone13
[link-contributors]: ../../contributors
