<?php

declare(strict_types=1);

namespace App\Trait;

trait CreatedOnTrait
{
    protected \DateTime $createdOn;

    public function getCreatedOn(): \Datetime
    {
        return $this->createdOn;
    }
}
