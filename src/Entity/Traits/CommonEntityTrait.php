<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait CommonEntityTrait
{
    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function autoUpdateDate(): void
    {
        if ($this->createdAt == null) {
            $this->setCreatedAt(new \DateTimeImmutable());
        }
        $this->setUpdatedAt(new \DateTimeImmutable());
    }
}
