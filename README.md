## PHP Maybe Monad

[![Build Status](https://travis-ci.org/haskellcamargo/php-maybe-monad.svg?branch=master)](https://travis-ci.org/haskellcamargo/php-maybe-monad)

To deal with computations that may fail.
A port of Haskell's `Data.Maybe` module for PHP.
**PHP > 5.4**

### Example

```php
<?php

Maybe\Maybe(@$_GET["username"])->bind(function($user)) {
  echo "Welcome, $user. You're logged in!";
});

$userAge = Maybe\Maybe(null)->fromMaybe(0); // => 0
$userAge = Maybe\Maybe(19)->fromMaybe(0); // => 19
```

### Documentation

A `Maybe` type encapsulates an optional value. A value of type `Maybe a`
either contains a value of type a (represented as `Just a`), or it is empty
(represented as `Nothing`). Using `Maybe` is a good way to deal with errors
or exceptional cases without resorting to drastic measures such as
`Exception`.
The `Maybe` type is also a monad. It is a simple kind of error monad, where
all errors are represented by `Nothing`. A richer error monad can be built
using the `Either` type.