<?php

namespace YCliff\EntityORM\traits;

trait Arrayable
{

    /**
     * Convert the actual instantiate object to an array.
     *
     * @return array The array converted.
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
