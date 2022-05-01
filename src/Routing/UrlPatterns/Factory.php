<?php

namespace Zherdev\KphpMVC\Routing\UrlPatterns;

class Factory {
  public static function createPlainPattern(string $url): UrlPatternInterface {
    $quoted = preg_quote($url);
    return new RegexUrlPattern("/^$quoted$/");
  }

  public static function createPrefixPattern(string $url_prefix): UrlPatternInterface {
    $quoted = preg_quote($url_prefix);
    return new RegexUrlPattern("/^$quoted(\/.*)?$/");
  }
}
