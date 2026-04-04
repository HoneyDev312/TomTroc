<?php

namespace App\Services {
    /**
     * Classe utilitaire : cette classe ne contient que des méthodes statiques qui peuvent être appelées
     * directement sans avoir besoin d'instancier un objet Utils.
     * Exemple : Utils::redirect('home'); 
     */

    use App\Core\Router;

    class Utils
    {

        /**
         * Redirige vers une URL.
         * @param string $routeName nom de la route
         * @param array $params : Facultatif, les paramètres de l'action sous la forme ['param1' => 'valeur1', 'param2' => 'valeur2']
         * @return void
         */
        public static function redirect(string $routeName, array $params = []): void
        {
            $path = Router::pathFor($routeName, $params);
            header('Location: /' . ltrim($path, '/'));
            exit;
        }

        /**
         * Cette méthode permet de récupérer une variable de la superglobale $_REQUEST.
         * Si cette variable n'est pas définie, on retourne la valeur null (par défaut)
         * ou celle qui est passée en paramètre si elle existe.
         * @param string $variableName : le nom de la variable à récupérer.
         * @param mixed $defaultValue : la valeur par défaut si la variable n'est pas définie.
         * @return mixed : la valeur de la variable ou la valeur par défaut.
         */
        public static function request(string $variableName, mixed $defaultValue = null): mixed
        {
            return $_REQUEST[$variableName] ?? $defaultValue;
        }

        /**
         * Cette methode permet de loguer les erreur dans un fichier app.log contenu dans le dossier logs
         * @param Throwable $e.
         * @return void 
         */
        public static function logException(\Throwable $e): void
        {

            $logFile = dirname(__DIR__, 2) . '/logs/app.log';
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
