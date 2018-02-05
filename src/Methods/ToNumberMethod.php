<?php

namespace App\Methods;

class ToNumberMethod implements MethodInterface
{
  /**
   * @param string $text
   * @return string
   */
  public function handle(string $text)
  {
    $numbers = explode(
      ' ',
      trim(preg_replace(
          '/\s+/',
          ' ',
          preg_replace('/\D/', ' ', $text)
        ))
    );
    return $numbers[array_rand($numbers)];
  }
}
