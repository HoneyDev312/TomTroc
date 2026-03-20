<?php

namespace App\Models\Managers {
    /**
     * Classe abstraite qui représente un manager. Elle récupère automatiquement le gestionnaire de base de données. 
     */

    use App\Models\Database;

    abstract class AbstractEntityManager
    {

        protected $db;

        /**
         * Constructeur de la classe.
         * Il récupère automatiquement l'instance de DBManager. 
         */
        public function __construct()
        {
            $this->db = Database::getInstance();
        }
    }
}
