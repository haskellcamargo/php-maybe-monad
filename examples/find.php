<?php

use HaskellCamargo\Maybe;

require __DIR__.'/../vendor/autoload.php';

function head(array $xs)
{
    if ([] === $xs) {
        return null;
    }

    return array_values($xs)[0];
}

// let's think this class belongs to doctrine
class ArrayMemory
{
    public function __construct(array $xs = [])
    {
        $this->xs = $xs;
    }

    public function find($entity, $name)
    {
        $xss = array_filter($this->xs, function ($x) use ($name) {
            return $x === $name;
        });

        $x = head($xss);

        if ($x) {
            return new $entity($x);
        }

        return null;
    }

}


// your codebase
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

class UserRepository
{
    public function __construct(ArrayMemory $em)
    {
        $this->em = $em;
    }

    public function findByName($name, User $def = null)
    {
        $user = $this->em->find(User::class, $name);

        return Maybe\Maybe($user)->fromMaybe($def ?: new User('None'));
    }
}

$users = ['Hetfield', 'Hendrix'];
$store = new ArrayMemory($users);
$repo = new UserRepository($store);

$hendrix = $repo->findByName('Hendrix');
$none = $repo->findByName('Fake', new User('Fred'));

assert($hendrix instanceof User);
assert($hendrix->getName() === 'Hendrix');

assert($none instanceof User);
assert($none->getName() === 'Fred');
