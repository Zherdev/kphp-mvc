<?php

namespace Zherdev\KphpMVC\Serving\HTTP;

class ResponseFactory {
  public static function notFound(): Response {
    return self::errorByCode(404);
  }

  public static function internalError(): Response {
    return self::errorByCode(500);
  }

  public static function withBody(string $body): Response {
    return (new Response())
      ->setStatusCode(200)
      ->setBody($body);
  }

  private static function errorByCode(int $code): Response {
    return (new Response())
      ->setStatusCode($code)
      ->setBody(Statuses::descriptionByCode($code));
  }
}
