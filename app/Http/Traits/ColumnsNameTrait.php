<?php

namespace App\Http\Traits;

trait ColumnsNameTrait
{
    public function getColumnsName()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
