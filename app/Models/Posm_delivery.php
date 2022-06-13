<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Posm;

class Posm_delivery extends Model
{
    use HasFactory;

    public function posm()
    {
      return $this->belongsTo(Posm::class);
    }

    public function consumer()
    {
      return $this->belongsTo(Consumer::class);
    }
}
