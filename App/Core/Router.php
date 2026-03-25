<?php

declare(strict_types=1);

namespace App\Core;

/**
 * Gère la collection de routes + le dispatch (choix de la route à exécuter).
 */
final class Router
{
    private array $routes = [];
    private static array $namedRoutes = [];


    public function get(string $path, array $handler): Route
    {
        $route = new Route('GET', $path, $handler);
        $this->addRoute($route);
        return $route;
    }

    public function post(string $path, array $handler): Route
    {
        $route = new Route('POST', $path, $handler);
        $this->addRoute($route);
        return $route;
    }

    private function addRoute(Route $route): void
    {
        $this->routes[] = $route;

        if ($route->getName() !== null) {
            self::$namedRoutes[$route->getName()] = $route;
        }
    }

    public function registerNamedRoute(Route $route): void
    {
        if ($route->getName() !== null) {
            self::$namedRoutes[$route->getName()] = $route;
        }
    }

    private function matchRoute(string $routePath, string $currentPath): array|false
    {
        $pattern = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_]*)\}#', '(?P<$1>[^/]+)', $routePath);
        $pattern = '#^' . $pattern . '$#';

        if (preg_match($pattern, $currentPath, $matches)) {
            return array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
        }

        return false;
    }

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
     * Exécute le bon contrôleur selon method + URI.
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
