<?php

namespace Zherdev\KphpMVC\Views;

use Zherdev\KphpMVC\Serving\HTTP;
use Zherdev\KphpMVC\Templates;

/**
 * Template-based view, which can return template as its response.
 */
abstract class AbstractTemplateView implements ViewInterface {
  abstract protected function getTemplate(): Templates\TemplateInterface;

  /** @param mixed $context */
  protected function expandTemplate(array $context): Response {
    return Response::expandTemplate(
      $this->getTemplate(),
      new Templates\Context($context)
    );
  }
}
