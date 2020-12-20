<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $guarded = [
        'id'
    ];

    public function serchValue($value)
    {
        if(!empty($value)) {
            return $this->where('name', 'like', '%'.$value.'%')->Paginate(6);
        }
        return $this->Paginate(6);
    }

    public function inventoryUpdate($stock_id)
    {
        $this->whereIn('id', $stock_id)->decrement('inventory', 1);
    }
}