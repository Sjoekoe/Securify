<?php
namespace App\Helpers;

use Carbon\Carbon;

trait StandardModel
{
    public function id()
    {
        return $this->id;
    }

    public function createdAt()
    {
        return Carbon::parse($this->created_at);
    }

    public function updatedAt()
    {
        return Carbon::parse($this->updated_at);
    }
}
