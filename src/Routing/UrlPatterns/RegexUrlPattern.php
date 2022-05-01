<?php

namespace Zherdev\KphpMVC\Routing\UrlPatterns;

class RegexUrlPattern implements UrlPatternInterface {
  private string $pattern;

  public function __construct(string $pattern) {
    $this->pattern = $pattern;
  }

  public function matches(string $url): bool {
    /** @var mixed */
    $matches = [];

    return (bool)preg_match($this->pattern, $url, $matches);
  }
}
