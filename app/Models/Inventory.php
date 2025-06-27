<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function suplier(){
        return $this->belongsTo(Suplier::class);
    }

    public function submission(){
        return $this->belongsTo(Submission::class);
    }

}
