<?php

namespace Zherdev\KphpMVC\Views;

use Zherdev\KphpMVC\Templates;

class Response {
  public const ACTION_SEND_PLAIN_TEXT = 0;
  public const ACTION_EXPAND_TEMPLATE = 1;

  private int $action;
  private string $plain_text;
  private ?Templates\TemplateInterface $template;
  private ?Templates\Context $template_context;

  public static function sendPlainText(string $text): self {
    return (new self())
      ->setAction(self::ACTION_SEND_PLAIN_TEXT)
      ->setPlainText($text);
  }

  public static function expandTemplate(Templates\TemplateInterface $template, Templates\Context $context): self {
    return (new self())
      ->setAction(self::ACTION_EXPAND_TEMPLATE)
      ->setTemplate($template)
      ->setTemplateContext($context);
  }

  public function getTemplate(): ?Templates\TemplateInterface {
    return $this->template;
  }

  public function getTemplateContext(): ?Templates\Context {
    return $this->template_context;
  }

  public function getAction(): int {
    return $this->action;
  }

  public function getPlainText(): string {
    return $this->plain_text;
  }

  private function setAction(int $action): self {
    $this->action = $action;
    return $this;
  }

  private function setTemplate(Templates\TemplateInterface $template): self {
    $this->template = $template;
    return $this;
  }

  private function setTemplateContext(Templates\Context $context): self {
    $this->template_context = $context;
    return $this;
  }

  private function setPlainText(string $text): self {
    $this->plain_text = $text;
    return $this;
  }
}
