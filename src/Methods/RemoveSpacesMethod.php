<?php

namespace App\Methods;

class RemoveSpacesMethod implements MethodInterface
{
  /**
   * @param string $text
   * @return string
   */
  public function handle(string $text)
  {
    return preg_replace('/\s+/', '', $text);
  }
}
