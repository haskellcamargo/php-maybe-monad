<?php

/*
 * Copyright (c) 2014 Marcelo Camargo <marcelocamargo@linuxmail.org>
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation files
 * (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge,
 * publish, distribute, sublicense, and/or sell copies of the Software,
 * and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial of portions the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
 * LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
 * WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace HaskellCamargo\Maybe;

interface MaybeInterface
{
    /**
     * Equivalent to Haskell's `>>=` operator. Its first argument is a value in
     * a monadic type, its second argument is a function that maps from the
     * underlying type of the first argument to another monadic type, and its
     * results is in that other monadic type.
     *
     * @param \Closure $fn
     * @return MaybeInterface
     */
    public function bind(\Closure $fn);

    /**
     * Extracts the element out of a `Just` and returns an error if its argument
     * is `Nothing`.
     *
     * @return mixed
     */
    public function fromJust();

    /**
     * Takes a `Maybe` value and a default value. If the `Maybe` is `Nothing`, it
     * returns the default values; otherwise, it returns the value contained in
     * the `Maybe`.
     *
     * @param $def
     *
     * @return mixed
     */
    public function fromMaybe($def);

    /**
     * Returns true if its argument is of the form `Just _`.
     *
     * @return bool
     */
    public function isJust();

    /**
     * Returns false if its arguments is of the form `Nothing`.
     *
     * @return bool
     */
    public function isNothing();

    /**
     * Takes a default value, a function and, of course, a `Maybe` value. If the
     * `Maybe` value is `Nothing`, the function returns the default value.
     * Otherwise, it applies the function to the value inside the `Just` and
     * returns the result.
     *
     * @param $def
     * @param $fn
     *
     * @return mixed
     */
    public function maybe($def, $fn);

    /**
     * Returns an empty list when given ``Nothing`` or a singleton list when not
     * given ``Nothing``.
     *
     * @see https://hackage.haskell.org/package/base-4.9.0.0/docs/src/Data.Maybe.html#maybeToList
     *
     * @return array
     */
    public function toList();
}
