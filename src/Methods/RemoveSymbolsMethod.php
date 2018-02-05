<?php

namespace App\Methods;

class RemoveSymbolsMethod implements MethodInterface
{
  /**
   * @param string $text
   * @return string
   */
  public function handle(string $text)
  {
    $symbols = ['[', '.', ',', '/', '!', '@', '#', '$', '%', '&', '*', '(', ')', ']'];
    return str_replace($symbols, '', $text);
  }
}
