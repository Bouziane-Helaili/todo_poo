<?php

require_once 'utilities/Database.php';

abstract class Model
{
    protected PDO $pdo;

    public function __construct()
    {
        echo "je suis la classe mère model";
        $this->pdo = Database::getPdo();
    }
}