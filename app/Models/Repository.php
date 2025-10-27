<?php

namespace Models;

use PDO;

class Repository
{
    protected $connection = null;

    public function __construct(PDO $pdo){
         $this->connection = $pdo;
    }

}
