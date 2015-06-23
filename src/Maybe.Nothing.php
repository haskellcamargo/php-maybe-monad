<?php
  # Copyright (c) 2014 Marcelo Camargo <marcelocamargo@linuxmail.org>
  #
  # Permission is hereby granted, free of charge, to any person
  # obtaining a copy of this software and associated documentation files
  # (the "Software"), to deal in the Software without restriction,
  # including without limitation the rights to use, copy, modify, merge,
  # publish, distribute, sublicense, and/or sell copies of the Software,
  # and to permit persons to whom the Software is furnished to do so,
  # subject to the following conditions:
  #
  # The above copyright notice and this permission notice shall be
  # included in all copies or substantial of portions the Software.
  #
  # THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
  # EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
  # MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
  # NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
  # LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
  # OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
  # WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

  namespace Maybe;
  use \Exception;

  # `Nothing` is a constructor of the `Maybe` type/monad. It doesn't take value.
  class Nothing extends Maybe implements IMaybe {

    # Equivalent to Haskell's `>>=` operator. Its first argument is a value in
    # a monadic type, its second argument is a function that maps from the
    # underlying type of the first argument to another monadic type, and its
    # results is in that other monadic type.
    function bind($_) { # :: (Maybe a, callable) -> Maybe b
      return $this;
    }

    # Extracts the element out of a `Just` and returns an error if its argument
    # is `Nothing`.
    function fromJust() { # :: Maybe a -> a
      throw new Exception("Cannot cal fromJust() on Nothing");
    }

    # Takes a `Maybe` value and a default value. If the `Maybe` is `Nothing`, it
    # returns the default values; otherwise, it returns the value contained in
    # the `Maybe`.
    function fromMaybe($def) { # :: (Maybe a, a) -> a
      return $def;
    }

    # Returns false if its argument is of the form `Just _`.
    function isJust() { # :: Maybe a -> boolean
      return false;
    }

    # Returns true if its arguments is of the form `Nothing`.
    function isNothing() { # :: Maybe a -> boolean
      return true;
    }

    # Takes a default value, a function and, of course, a `Maybe` value. If the
    # `Maybe` value is `Nothing`, the function returns the default value.
    # Otherwise, it applies the function to the value inside the `Just` and
    # returns the result.
    function maybe($def, $_) { # :: (Maybe a, b, callable) -> b
      return $def;
    }

    # Returns an empty list when given ``Nothing`` or a singleton list when not
    # given ``Nothing``.
    function toList() { # :: Maybe a -> array
      return [];
    }
  }
