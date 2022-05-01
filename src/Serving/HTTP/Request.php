<?php

namespace Zherdev\KphpMVC\Serving\HTTP;

class Request {
  private string $path = '';

  public static function parse(): self {
    $result = new self();

    $result->path = (string)parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

    return $result;
  }

  public function getPath(): string {
    return $this->path;
  }
}
