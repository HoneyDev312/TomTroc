<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Représente une route unitaire:
 * - méthode HTTP (GET, POST, ...)
 * - chemin (ex: "book/{id}")
 * - handler (ex: [BooksController::class, 'showBook'])
 * - nom optionnel (ex: "books.show")
 */
final class Route
{
    /**
     * Méthode HTTP attendue pour cette route.
     */
    private string $method;

    /**
     * Chemin de la route, sans slash en début/fin.
     */
    private string $path;

    /**
     * Handler à exécuter: [NomDuController::class, 'nomMethode'].
     */
    private array $handler;

    /**
     * Nom de route optionnel, utilisé pour générer des URLs.
     */
    private ?string $name = null;

    /**
     * Construit une route.
     * - normalise la méthode en majuscules
     * - normalise le chemin (trim des /)
     */
    public function __construct(string $method, string $path, array $handler)
    {
        $this->method = strtoupper($method);
        $this->path = trim($path, '/');
        $this->handler = $handler;
    }

    /**
     * Retourne la méthode HTTP de la route.
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Retourne le chemin de la route.
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Retourne le handler [Controller::class, 'method'].
     */
    public function getHandler(): array
    {
        return $this->handler;
    }

    /**
     * Associe un nom à l'instance courante.
     * Utilisation actuelle :
     * $r = $router->get('book/{id}', [BooksController::class, 'showBook']);
     * $r->name('book.show');
     * $router->registerNamedRoute($r);
     */
    public function name(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Retourne le nom de la route (ou null si non défini).
     */
    public function getName(): ?string
    {
        return $this->name;
    }
}
