<?php

namespace Zherdev\KphpMVC\Templates;

class Context {
  /** @var mixed $values */
  private array $values;

  /** @param mixed $values */
  public function __construct(array $values) {
    $this->values = $values;
  }

  /** @return ?mixed */
  public function getValue(string $key) {
    return array_key_exists($key, $this->values) ? $this->values[$key] : null;
  }
}
