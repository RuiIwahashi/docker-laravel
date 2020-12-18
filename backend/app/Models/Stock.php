<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
   protected $guarded = [
     'id'
   ];

   public function inventoryUpdate($stock_id)
   {
       $this->whereIn('id', $stock_id)->decrement('inventory', 1);
   }
}