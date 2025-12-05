<?php

namespace App;


readonly class User {

    public function __construct(
        public string $name,
        public string $surname
    ) {
    }

}
