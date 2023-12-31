<?php

namespace App\Models;

/**
 * Abstract class Table
 * @package App\Models\Table
 */
abstract class AbstractTable
{
    protected ?int $id = null;
    public function __construct(?int $id = null)
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getId():?int{
        return $this->id;
    }
    public function setId(?int $id): void{
        $this->id = $id;
        
    }
}
