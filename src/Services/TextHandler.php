<?php

namespace App\Services;

use App\Methods\HtmlSpecialCharsMethod;
use App\Methods\MethodInterface;
use App\Methods\RemoveSpacesMethod;
use App\Methods\RemoveSymbolsMethod;
use App\Methods\ReplaceSpacesToEolMethod;
use App\Methods\StripTagsMethod;
use App\Methods\ToNumberMethod;
use Doctrine\ORM\EntityManager;

class TextHandler {
  /**
   * @var
   */
  private $text;

  /**
   * @var array
   */
  private $methods = [];

  /**
   * @var array
   */
  private $errors = [];

  /**
   * @param string $text
   */
  public function setText(string $text)
  {
    $this->text = $text;
  }

  /**
   * @return mixed
   */
  public function getText()
  {
    return $this->text;
  }

  /**
   * @return mixed
   */
  public function getMethods()
  {
    return $this->methods;
  }

  /**
   * @param MethodInterface|null $method
   */
  public function addMethod(?MethodInterface $method)
  {
    if ($method) {
      $isSuchMethod = false;
      $methodClass = get_class($method);
      foreach ($this->methods as $instance) {
        if (is_a($instance, $methodClass)) {
          $isSuchMethod = true;
          break;
        }
      }

      if (!$isSuchMethod) {
        $this->methods[] = $method;
      }
    }
  }

  /**
   * @param array $methodNames
   */
  public function addMethods(array $methodNames)
  {
    foreach ($methodNames as $methodName) {
      $this->addMethod($this->mapMethod($methodName));
    }
  }

  /**
   * @return mixed
   */
  public function handle()
  {
    foreach ($this->methods as $method) {
      $this->setText($method->handle($this->text));
    }

    return $this->getText();
  }

  /**
   * @return array
   */
  public function getErrors()
  {
    return $this->errors;
  }

  /**
   * @param $stringEquivalent
   * @return mixed
   */
  public function mapMethod($stringEquivalent)
  {
    switch ($stringEquivalent) {
      case 'stripTags':
        return new StripTagsMethod();
      case 'removeSpaces':
        return new RemoveSpacesMethod();
      case 'replaceSpacesToEol':
        return new ReplaceSpacesToEolMethod();
      case 'htmlspecialchars':
        return new HtmlSpecialCharsMethod();
      case 'removeSymbols':
        return new RemoveSymbolsMethod();
      case 'toNumber':
        return new ToNumberMethod();
      default:
        $this->errors[] = 'Method \'' . $stringEquivalent . '\' doesn\'t exist.';
        return null;
    }
  }
}
