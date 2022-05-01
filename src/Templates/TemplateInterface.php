<?php

namespace Zherdev\KphpMVC\Templates;

use Zherdev\KphpMVC\Errors\Err;

interface TemplateInterface {
  /** @return tuple(string, Err) */
  public function render(Context $context);
}
