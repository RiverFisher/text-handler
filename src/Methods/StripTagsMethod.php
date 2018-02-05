<?php

namespace App\Methods;

class StripTagsMethod implements MethodInterface
{
  /**
   * @param string $text
   * @return string
   */
  public function handle(string $text)
  {
    return strip_tags($text);
  }
}
