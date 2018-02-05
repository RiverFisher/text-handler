<?php

namespace App\Methods;

class HtmlSpecialCharsMethod implements MethodInterface
{
  /**
   * @param string $text
   * @return string
   */
  public function handle(string $text)
  {
    $symbols = ['[', '.', ',', '/', '!', '@', '#', '$', '%', '&', '*', '(', ')', ']'];
    $replace = $symbols;
    foreach ($replace as $key => $value) {
      $replace[$key] = '\\' . $value;
    }
    return str_replace($symbols, $replace, $text);
  }
}
