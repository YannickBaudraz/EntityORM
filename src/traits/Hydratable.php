<?php

namespace YCliff\EntityORM\traits;

trait Hydratable
{

    public function hydrate(array $fields): void
    {
        foreach ($fields as $key => $value) {
            if (property_exists(static::class, $key)) {
                $this->$key = $value;
            }
        }
    }
}
