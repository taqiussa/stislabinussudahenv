<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswasementara extends Model
{
    use HasFactory;
    protected $table = 'siswasementara';
    protected $guarded = ['id', 'created_at', 'updated_at'];

}
