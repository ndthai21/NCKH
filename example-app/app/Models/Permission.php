<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends \Spatie\Permission\Models\Permission
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name',
        'group',
    ];
}
