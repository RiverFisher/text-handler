<?php

use PHPUnit\Framework\TestCase;

class ToNumberMethodTest extends TestCase
{
  public function testHandle()
  {
    $text = <<<HEREDOC
Привет, мне на <a href="test@test.ru">test@test.ru</a> пришло приглашение встретиться, попить кофе с <strong>10%</strong> содержанием молока за <i>$5</i>, пойдем вместе!
HEREDOC;

    $method = new \App\Methods\ToNumberMethod();

    $expectation = 10; // if FAILURE then change to 5 :-) because I use random of numbers

    $this->assertEquals($expectation, $method->handle($text));
  }
}
