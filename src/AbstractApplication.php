<?php

namespace Zherdev\KphpMVC;

use Zherdev\KphpMVC\Routing\Router;
use Zherdev\KphpMVC\Serving\Server;
use Zherdev\KphpMVC\Views\ViewInterface;

abstract class AbstractApplication {
  protected ?Router $router = null;

  public function run(): void {
    $this->registerViewUrls();

    $server = new Server();
    $server->setRouter($this->router);
    $server->serve();
  }

  abstract protected function registerViewUrls(): void;

  protected function registerViewUrl(string $url, ViewInterface $view): void {
    if ($this->router === null) {
      $this->router = new Router();
    }

    $this->router->addUrl($url, $view);
  }
}
