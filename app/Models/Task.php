<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

   protected $table    = 'tasks';
   protected $fillable = [
      'id',
      'name',
      'start_date',
      'end_date',
      'user_id',
      'created_at',
      'updated_at',
   ];

   protected $perPage = 10;

   /**
    * Get the user that owns the Banner
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function user()
   {
      return $this->belongsTo(User::class, 'user_id');
   }
}
