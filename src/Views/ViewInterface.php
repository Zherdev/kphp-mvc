<?php

namespace Zherdev\KphpMVC\Views;

use Zherdev\KphpMVC\Serving\HTTP;

interface ViewInterface {
  public function process(HTTP\Request $request): Response;
}
