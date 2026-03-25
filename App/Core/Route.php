<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Représente UNE route (méthode HTTP + chemin + handler + nom optionnel).
 */
final class Route
{
    private string $method;
    private string $path;
    private array $handler;
    private ?string $name = null;

    public function __construct(string $method, string $path, array $handler)
    {
        $this->method = strtoupper($method);
        $this->path = trim($path, '/');
        $this->handler = $handler;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getHandler(): array
    {
        return $this->handler;
    }

    public function name(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
