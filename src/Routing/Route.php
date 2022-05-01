<?php

namespace Zherdev\KphpMVC\Routing;

use Zherdev\KphpMVC\Routing\UrlPatterns\UrlPatternInterface;
use Zherdev\KphpMVC\Views\ViewInterface;

class Route {
  public const TYPE_VIEW  = 0;
  public const TYPE_GROUP = 1;

  private UrlPatternInterface $url_pattern;
  private int $type;
  private ?ViewInterface $view;
  private ?Router $group_router;

  public static function routeView(UrlPatternInterface $url_pattern, ViewInterface $view): self {
    return new self($url_pattern, self::TYPE_VIEW, $view, null);
  }

  public static function routeGroup(UrlPatternInterface $url_pattern, Router $group_router): self {
    return new self($url_pattern, self::TYPE_GROUP, null, $group_router);
  }

  public function matches(string $url): bool {
    return $this->url_pattern->matches($url);
  }

  public function getType(): int {
    return $this->type;
  }

  public function getView(): ?ViewInterface {
    return $this->view;
  }

  public function getGroupRouter(): ?Router {
    return $this->group_router;
  }

  private function __construct(
    UrlPatternInterface $url_pattern,
    int $type,
    ?ViewInterface $view,
    ?Router $group_router
  ) {
    $this->url_pattern  = $url_pattern;
    $this->type         = $type;
    $this->view         = $view;
    $this->group_router = $group_router;
  }
}
