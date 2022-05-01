<?php

namespace Zherdev\KphpMVC\Templates;

use Zherdev\KphpMVC\Errors\Err;

/**
 * Template based on default PHP template engine.
 */
abstract class AbstractPhpTemplate implements TemplateInterface {
  /** @return tuple(string, Err) */
  public function render(Context $context) {
    return tuple($this->getHTML($context), null);
  }

  abstract protected function getHTML(Context $context): string;
}
