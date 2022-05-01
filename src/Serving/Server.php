<?php

namespace Zherdev\KphpMVC\Serving;

use Zherdev\KphpMVC\Routing\Router;
use Zherdev\KphpMVC\Views;

class Server {
  private Router $router;

  public function setRouter(Router $router): self {
    $this->router = $router;
    return $this;
  }

  public function serve(): void {
    $request = HTTP\Request::parse();
    $path    = $request->getPath();

    [$view, $err] = $this->router->route($path);
    if ($err !== null) {
      self::sendNotFound();
      return;
    }

    $response = $this->processView($view, $request);

    $this->sendResponse($response);
  }

  private function processView(Views\ViewInterface $view, HTTP\Request $request): HTTP\Response {
    $view_result = $view->process($request);

    switch ($view_result->getAction()) {
      case Views\Response::ACTION_SEND_PLAIN_TEXT:
        return HTTP\ResponseFactory::withBody($view_result->getPlainText());

      case Views\Response::ACTION_EXPAND_TEMPLATE:
        $template = $view_result->getTemplate();
        $context  = $view_result->getTemplateContext();
        [$body, $err] = $template->render($context);
        if ($err !== null) {
          return HTTP\ResponseFactory::internalError();
        }
        return HTTP\ResponseFactory::withBody($body);

      default:
        return HTTP\ResponseFactory::internalError();
    }
  }

  private function sendResponse(HTTP\Response $response): void {
    header($response->getStatusLine(), true, $response->getStatusCode());
    echo $response->getBody();
  }

  private function sendNotFound(): void {
    $response = HTTP\ResponseFactory::notFound();
    $this->sendResponse($response);
  }
}
