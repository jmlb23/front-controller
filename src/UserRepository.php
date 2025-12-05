<?php

namespace App;

use PDO;

class UserRepository {

    private ?PDO $connection = null;
    

    public function __construct(PDO $con) {
        $this->connection = $con;
    }

    public function add(User $user): void {
        $stm = $this->connection->prepare("INSERT INTO users (username, surname) values (?, ?)");
        $stm->execute([$user->name, $user->surname]);
    }

    public function asList(): array {
        return $this->users;
    }
}

