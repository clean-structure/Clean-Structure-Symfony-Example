<?php

declare(strict_types=1);

namespace CleanStructure\UserManagement\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity()]
final class User
{
    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: "uuid", unique: true)]
        public UuidInterface $id,
        #[ORM\Column(length: 255, unique: true)]
        public string $name
    ) {
    }
}
