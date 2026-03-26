<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Router = composant qui:
 * 1) enregistre les routes de l'application
 * 2) choisit la bonne route selon l'URL + méthode HTTP
 * 3) exécute la méthode de contrôleur associée
 */
final class Router
{
    /**
     * Liste des routes "vivantes" de l'application.
     * Exemple d'entrée: Route(GET, "book/{id}", [BooksController::class, "showBook"])
     */
    private array $routes = [];

    /**
     * Index des routes nommées.
     * But: générer des URLs par nom (ex: "my-account.show") via pathFor().
     *
     * static car pathFor() est statique (Utils::redirect peut l'appeler sans instance).
     */
    private static array $namedRoutes = [];

    /**
     * Déclare une route GET.
     */
    public function get(string $path, array $handler): Route
    {
        $route = new Route('GET', $path, $handler);
        $this->addRoute($route);
        return $route;
    }

    /**
     * Déclare une route POST.
     */
    public function post(string $path, array $handler): Route
    {
        $route = new Route('POST', $path, $handler);
        $this->addRoute($route);
        return $route;
    }

    /**
     * Ajoute la route dans la collection principale.
     * Si elle est déjà nommée, on la met aussi dans l'index des routes nommées.
     */
    private function addRoute(Route $route): void
    {
        $this->routes[] = $route;

        if ($route->getName() !== null) {
            self::$namedRoutes[$route->getName()] = $route;
        }
    }

    /**
     * Enregistre explicitement une route nommée.
     * Utile car ->name() est appelé après get()/post() dans ton usage.
     */
    public function registerNamedRoute(Route $route): void
    {
        if ($route->getName() !== null) {
            self::$namedRoutes[$route->getName()] = $route;
        }
    }

    /**
     * Compare un pattern de route (ex: "book/{id}") avec le path courant (ex: "book/18").
     *
     * Étapes:
     * - transforme "{id}" en regex nommée "(?P<id>[^/]+)"
     * - teste la regex contre l'URL courante
     * - retourne les paramètres extraits sous forme ['id' => '18']
     * - retourne false si pas de match
     */
    private function matchRoute(string $routePath, string $currentPath): array|false
    {
        $pattern = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', '(?P<$1>[^/]+)', $routePath);
        $pattern = '#^' . $pattern . '$#';

        if (preg_match($pattern, $currentPath, $matches)) {
            return array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
        }

        return false;
    }

    /**
     * Génère un chemin à partir d'un nom de route.
     * Exemple:
     * - route nommée "my-account.show" => path "my-account/{id}"
     * - params ['id' => 7]
     * - résultat "my-account/7"
     */
    public static function pathFor(string $name, array $params = []): string
    {
        if (!isset(self::$namedRoutes[$name])) {
            throw new \RuntimeException("Route '$name' introuvable.");
        }

        $path = self::$namedRoutes[$name]->getPath();

        foreach ($params as $key => $value) {
            $path = str_replace('{' . $key . '}', (string) $value, $path);
        }

        return $path;
    }

    /**
     * Cœur du routeur: dispatch.
     *
     * - normalise la méthode HTTP (GET/POST...)
     * - extrait le path de l'URI (sans query string)
     * - parcourt toutes les routes enregistrées
     * - cherche une route dont:
     *   1) la méthode HTTP correspond
     *   2) le path matche (avec ou sans paramètres dynamiques)
     * - instancie le contrôleur et appelle la méthode cible
     * - injecte les paramètres dynamiques dans l'ordre
     *
     * Si aucune route ne matche, lève une exception 404.
     */
    public function dispatch(string $method, string $uri): void
    {
        $method = strtoupper($method);
        $path = trim(parse_url($uri, PHP_URL_PATH) ?? '', '/');

        foreach ($this->routes as $route) {
            $params = $this->matchRoute($route->getPath(), $path);
            if ($route->getMethod() === $method && $params !== false) {
                [$controllerClass, $controllerMethod] = $route->getHandler();
                $controller = new $controllerClass();
                $controller->$controllerMethod(...array_values($params));
                return;
            }
        }

        throw new \RuntimeException("La page demandée n'existe pas.");
    }
}
