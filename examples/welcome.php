<?php

use HaskellCamargo\Maybe;

require __DIR__.'/../vendor/autoload.php';

class User
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}

class Welcome
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name ?: null;
    }

    public function hello()
    {
        $user = new User(
            Maybe\Maybe($this->name)->fromMaybe('Unknown')
        );

        return sprintf('Hello, %s', $user->getName());
    }
}

echo 'Type your name: ';
$name = trim(fgets(STDIN));

echo (new Welcome($name))->hello();
