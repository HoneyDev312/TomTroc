<?php

namespace App\Services {
    /**
     * Classe utilitaire : cette classe ne contient que des méthodes statiques qui peuvent être appelées
     * directement sans avoir besoin d'instancier un objet Utils.
     * Exemple : Utils::redirect('home'); 
     */
    class Utils
    {

        /**
         * Redirige vers une URL.
         * @param string $action : l'action que l'on veut faire (correspond aux actions dans le routeur).
         * @param array $params : Facultatif, les paramètres de l'action sous la forme ['param1' => 'valeur1', 'param2' => 'valeur2']
         * @return void
         */
        public static function redirect(string $routeName, array $params = []): void
        {
            $path = \App\Core\Router::pathFor($routeName, $params); // ex: my-account/{id} -> my-account/7
            header('Location: /' . ltrim($path, '/'));
            exit;
        }

        /**
         * Cette méthode permet de loguer les erreur.
         * @param Throwable 
         * @return mixed : la valeur de la variable ou la valeur par défaut.
         */
        public static function request(string $variableName, mixed $defaultValue = null): mixed
        {
            return $_REQUEST[$variableName] ?? $defaultValue;
        }

        /**
         * Cette méthode permet de récupérer une variable de la superglobale $_REQUEST.
         * Si cette variable n'est pas définie, on retourne la valeur null (par défaut)
         * ou celle qui est passée en paramètre si elle existe.
         * @param string $variableName : le nom de la variable à récupérer.
         * @param mixed $defaultValue : la valeur par défaut si la variable n'est pas définie.
         * @return void 
         */
        public static function logException(\Throwable $e): void
        {

            $logFile = dirname(__DIR__, 2) . '/logs/app.log'; // racine projet/logs/app.log
            $logDir = dirname($logFile);

            if (!is_dir($logDir)) {
                mkdir($logDir, 0775, true);
            }

            error_log(
                sprintf(
                    "[%s] %s in %s:%d\n%s",
                    date('Y-m-d H:i:s'),
                    $e->getMessage(),
                    $e->getFile(),
                    $e->getLine(),
                    $e->getTraceAsString()
                ),
                3,
                $logFile
            );
        }
    }
}
