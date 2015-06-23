## PHP Maybe Monad

[![Build Status](https://travis-ci.org/haskellcamargo/php-maybe-monad.svg?branch=master)](https://travis-ci.org/haskellcamargo/php-maybe-monad)

To deal with computations that may fail.
A port of Haskell's `Data.Maybe` module for PHP.
**PHP > 5.4**

### Example

```php
<?php

require_once "./src/Maybe.php";

Maybe\Maybe(@$_GET["username"])->bind(function($user)) {
  echo "Welcome, $user->. You're logged in!";
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

#### bind :: (Maybe a, callable) -> Maybe b

Equivalent to Haskell's `>>=` operator. Its first argument is a value in
a monadic type, its second argument is a function that maps from the
underlying type of the first argument to another monadic type, and its
results is in that other monadic type.

```php
$age = \Maybe\Maybe(null)->bind(function($x) {
  return 10;
}); // => Nothing

$age = \Maybe\Maybe(10)
->bind(function($x) {
  return $x + 10; // => Just(20);
})
->bind(function($x) {
  return $x + 20; // => Just(40);
})->fromJust(); // => 40
```

#### fromJust :: Maybe a -> a

Extracts the element out of a `Just` and returns an error if its argument
is `Nothing`.

```php
\Maybe\Maybe("Foo")->fromJust(); // => "Foo"
\Maybe\Maybe(null)->fromJust(); // => Exception: Cannot cal fromJust() on Nothing
```

#### fromMaybe :: (Maybe a, a) -> a

Takes a `Maybe` value and a default value. If the `Maybe` is `Nothing`, it
returns the default values; otherwise, it returns the value contained in
the `Maybe`.

```php
\Maybe\Maybe(10)->fromMaybe(5); // => 10
\Maybe\Maybe(null)->fromMaybe(5); // => 5
```

#### isJust :: Maybe a -> boolean

Returns true if its argument is of the form `Just _`.

```php
\Maybe\Maybe(10)->isJust(); // => true
\Maybe\Maybe(null)->isJust(); // => false
```

#### isNothing :: Maybe a -> boolean

Returns true if its argument is of the form `Nothing`.

```php
\Maybe\Maybe(10)->isNothing(); // => false
\Maybe\Maybe(null)->isNothing(); // => true
```

#### maybe :: (Maybe a, b, callable) -> b

Takes a default value, a function and, of course, a `Maybe` value. If the
`Maybe` value is `Nothing`, the function returns the default value.
Otherwise, it applies the function to the value inside the `Just` and
returns the result.

```php
$just = \Maybe\Maybe(10);
$nothing = \Maybe\Maybe(null);

$just->maybe(40, function($num) {
        return $num + 15;
}); // => 25

$nothing->maybe(40, function($num) {
  return $num + 15;
}); // => 40
```

#### toList :: Maybe a -> array

Returns an empty list when given ``Nothing`` or a singleton list when not
given ``Nothing``.

```php
\Maybe\Maybe(10)->toList(); // => [10]
\Maybe\Maybe(null)->toList(); // => []
```

Made with :heart: by Marcelo Camargo
