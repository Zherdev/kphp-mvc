<?php

namespace Zherdev\KphpMVC\Serving\HTTP;

class Response {
  private int $status_code = 0;
  private string $body = '';

  public function setStatusCode(int $status_code): self {
    $this->status_code = $status_code;
    return $this;
  }

  public function setBody(string $body): self {
    $this->body = $body;
    return $this;
  }

  public function getStatusCode(): int {
    return $this->status_code;
  }

  public function getBody(): string {
    return $this->body;
  }

  public function getStatusLine(): string {
    $proto       = (string)$_SERVER["SERVER_PROTOCOL"];
    $code        = $this->getStatusCode();
    $description = Statuses::descriptionByCode($code);
    return "$proto $code $description";
  }
}
