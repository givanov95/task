<?php

declare(strict_types=1);

namespace App\Documents\Components;

class Customer extends Component
{
    public function __construct(
        public readonly string $names,
        public readonly string $email
    ) {
    }
}
