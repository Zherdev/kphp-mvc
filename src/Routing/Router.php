<?php

namespace Zherdev\KphpMVC\Routing;

use Zherdev\KphpMVC\Errors\Err;
use Zherdev\KphpMVC\Views\ViewInterface;

class Router {
  /** @var Route[] $routes */
  private array $routes = [];

  public function addUrl(string $url, ViewInterface $view): self {
    $pattern        = UrlPatterns\Factory::createPlainPattern($url);
    $this->routes[] = Route::routeView($pattern, $view);

    return $this;
  }

  public function addUrlsGroup(string $group_url_prefix, self $router): self {
    $pattern        = UrlPatterns\Factory::createPrefixPattern($group_url_prefix);
    $this->routes[] = Route::routeGroup($pattern, $router);

    return $this;
  }

  /**
   * @return tuple(?ViewInterface, ?Err)
   */
  public function route(string $url) {
    foreach ($this->routes as $route) {
      if (!$route->matches($url)) {
        continue;
      }

      switch ($route->getType()) {
        case Route::TYPE_VIEW:
          return tuple($route->getView(), null);

        case Route::TYPE_GROUP:
          return $route->getGroupRouter()->route($url);
      }
    }

    return tuple(null, new Err("router: view not found for url $url"));
  }
}
