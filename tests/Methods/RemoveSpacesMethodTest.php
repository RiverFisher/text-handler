<?php

use PHPUnit\Framework\TestCase;

class RemoveSpacesMethodTest extends TestCase
{
  public function testHandle()
  {
    $text = <<<HEREDOC
Привет, мне на <a href="test@test.ru">test@test.ru</a> пришло приглашение встретиться, попить кофе с <strong>10%</strong> содержанием молока за <i>$5</i>, пойдем вместе!
HEREDOC;

    $method = new \App\Methods\RemoveSpacesMethod();

    $expectation = <<<HEREDOC
Привет,мнена<ahref="test@test.ru">test@test.ru</a>пришлоприглашениевстретиться,попитькофес<strong>10%</strong>содержаниеммолоказа<i>$5</i>,пойдемвместе!
HEREDOC;

    $this->assertEquals($expectation, $method->handle($text));
  }
}
