<?php

use PHPUnit\Framework\TestCase;

class StripTagsMethodTest extends TestCase
{
  public function testHandle()
  {
    $text = <<<HEREDOC
Привет, мне на <a href="test@test.ru">test@test.ru</a> пришло приглашение встретиться, попить кофе с <strong>10%</strong> содержанием молока за <i>$5</i>, пойдем вместе!
HEREDOC;

    $method = new \App\Methods\StripTagsMethod();

    $expectation = <<<HEREDOC
Привет, мне на test@test.ru пришло приглашение встретиться, попить кофе с 10% содержанием молока за $5, пойдем вместе!
HEREDOC;

    $this->assertEquals($expectation, $method->handle($text));
  }
}
