<?php

namespace App\Methods;

class ReplaceSpacesToEolMethod implements MethodInterface
{
  /**
   * @param string $text
   * @return string
   */
  public function handle(string $text)
  {
    return preg_replace('/\s+/', PHP_EOL, $text);
  }
}
