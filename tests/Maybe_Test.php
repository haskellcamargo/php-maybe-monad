<?php

namespace Tests
{
  require_once "./src/Maybe.php";

  class Maybe_Test extends \PHPUnit_Framework_TestCase
  {
    public function testInstance()
    {
      $shouldBeNothing = \Maybe\Maybe(null);
      $shouldBeJust = \Maybe\Maybe(1);
      $this->assertEquals(true, $shouldBeNothing instanceof \Maybe\Nothing);
      $this->assertEquals(true, $shouldBeJust instanceof \Maybe\Just);
    }

    public function testBind()
    {
      $just = null;
      $nothing = null;

      \Maybe\Maybe(10)->bind(function($num) use (&$just) {
        $just = $num;
      });

      \Maybe\Maybe(null)->bind(function($num) use (&$just) {
        $just = 10;
      });

      $this->assertEquals(10, $just);
      $this->assertEquals(null, $nothing);
    }

    public function testFromJustPass()
    {
      $just = \Maybe\Maybe(10);
      $this->assertEquals(10, $just->fromJust());
    }

    /**
     * @expectedException Exception
     */
    public function testFromJustFail()
    {
      $nothing = \Maybe\Maybe(null);
      $nothing->fromJust();
    }

    public function testFromMaybe()
    {
      $just = \Maybe\Maybe(10);
      $nothing = \Maybe\Maybe(null);

      $this->assertEquals(10, $just->fromMaybe(5));
      $this->assertEquals(5, $nothing->fromMaybe(5));
    }

    public function testIsJust()
    {
      $just = \Maybe\Maybe(10);
      $nothing = \Maybe\Maybe(null);

      $this->assertEquals(true, $just->isJust());
      $this->assertEquals(false, $nothing->isJust());
    }

    public function testIsNothing()
    {
      $just = \Maybe\Maybe(10);
      $nothing = \Maybe\Maybe(null);

      $this->assertEquals(false, $just->isNothing());
      $this->assertEquals(true, $nothing->isNothing());
    }

    public function testMaybe()
    {
      $just = \Maybe\Maybe(10);
      $nothing = \Maybe\Maybe(null);

      $this->assertEquals(25, $just->maybe(40, function($num) {
        return $num + 15;
      }));
      $this->assertEquals(40, $nothing->maybe(40, function($num) {
        return $num + 15;
      }));
    }

    public function testToList()
    {
      $just = \Maybe\Maybe(10);
      $nothing = \Maybe\Maybe(null);

      $this->assertEquals([10], $just->toList());
      $this->assertEquals([], $nothing->toList());
    }
  }
}