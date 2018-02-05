<?php

namespace App\Services;

class JobHandler {
  /**
   * @param $job
   * @return bool|string
   */
  public function detectText($job) {
    $from = strpos($job, '\'text\': \'') + 9;
    for ($currentSymbol = $from; $currentSymbol <= strlen($job); $currentSymbol++) {
      if (substr($job, $currentSymbol, 1) == '\'') {
        break;
      }
    }
    $to = $currentSymbol - 1;
    return substr($job, $from, $to - $from + 1);
  }

  /**
   * @param $job
   * @return array
   */
  public function detectMethods($job) {
    $from = strpos($job, '\'methods\': [') + 12;
    for ($currentSymbol = $from; $currentSymbol <= strlen($job); $currentSymbol++) {
      if (substr($job, $currentSymbol, 1) == ']') {
        break;
      }
    }
    $to = $currentSymbol - 1;

    $preparedString = preg_replace('/(\s+)|\'/', '', substr($job, $from, $to - $from + 1));
    return explode(',', $preparedString);
  }
}
