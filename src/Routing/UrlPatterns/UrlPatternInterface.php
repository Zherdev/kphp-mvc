<?php

namespace Zherdev\KphpMVC\Routing\UrlPatterns;

interface UrlPatternInterface {
  public function matches(string $url): bool;
}
