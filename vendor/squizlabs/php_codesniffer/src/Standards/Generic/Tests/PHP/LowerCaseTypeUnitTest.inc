<?php
$foo = (int) $bar;
$foo = (integer) $bar;
$foo = (bool) $bar;
$foo = (boolean) $bar;
$foo = (float) $bar;
$foo = (double) $bar;
$foo = (real) $bar;
$foo = (string) $bar;
$foo = (array) $bar;
$foo = (object) $bar;
$foo = (unset) $bar;

$foo = (Int) $bar;
$foo = (INTEGER) $bar;
$foo = (BOOL) $bar;
$foo = (String) $bar;
$foo = (Array) $bar;

function foo(int $a, string $b, bool $c, array $d, Foo\Bar $e) : int {}
function foo(Int $a, String $b, BOOL $c, Array $d, Foo\Bar $e) : Foo\Bar {}
function foo(Int $a, Bar $b, BOOL $c, Array $d, Foo\Bar $e) : Bar {}
function foo(callable $a, Callable $b, self $c, Iterable $d, iterable $e) : Float {}

$foo = function (int $a, Bool $b) {};
$foo = function (int $a, Callable $b) :INT{};
$foo = function (BOOL $a, float $b) use ($foo) : INT {};
$foo = function (Foo $a, Foo\Bar $b) use ($foo) : \Foo\Bar {};
$foo = function (bool $a, callable $b) use ($foo) : Bar {};

class Testing {
    public function TestThis(SELF $a, obJect $b, Parent $c) : VOID {}
}

function foo(
    ?Float $a,
    ? String $b,
    ?ITERABLE $c,
    ?	Object $d,
    ?Foo\Bar $e
) : ?Foo\Bar {}

$foo = function (?Int $a, ?    Callable $b)
    :?INT{};

$var = (BInARY) $string;
$var = (binary)$string;
