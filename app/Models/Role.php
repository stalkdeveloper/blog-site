<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'roles';

    protected $primarykey = "id";
    protected $foreignkey = "user_id";

    protected $fillable = [
        'user_id',
        'can_create',
        'can_read',
        'can_update',
        'can_delete',
        'module',
    ];

    public function users()
    {
        return $this->belongsTo("App\Models\User", "user_id");
    }
}
