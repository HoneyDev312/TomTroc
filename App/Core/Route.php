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
     * Callback optionnel fourni par le Router.
     * Il est appelé quand la route reçoit un nom via ->name(...),
     * pour l'enregistrer automatiquement dans la collection des routes nommées.
     */
    private ?\Closure $onNamed;

    /**
     * Construit une route.
     * - normalise la méthode en majuscules
     * - normalise le chemin (trim des /)
     */
    public function __construct(string $method, string $path, array $handler, ?\Closure $onNamed = null)
    {
        $this->method = strtoupper($method);
        $this->path = trim($path, '/');
        $this->handler = $handler;
        $this->onNamed = $onNamed;
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
     * Associe un nom à cette route (ex: "books.show").
     * Si un callback d'enregistrement existe, on le déclenche
     * pour que le Router indexe immédiatement cette route nommée.
     */
    public function name(string $name): self
    {
        $this->name = $name;

        if ($this->onNamed !== null) {
            ($this->onNamed)($this);
        }

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
