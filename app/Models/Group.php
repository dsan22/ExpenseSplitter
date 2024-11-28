<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function users()  {
        return $this->belongsToMany(User::class);
    }

    public function expenses(){
        return $this->hasMany(Expense::class);
    }
    public function invitations()
{
    return $this->hasMany(GroupInvitation::class);
}

    protected $guarded=['id'];

    protected $casts = [
        'finished' => 'boolean',
    ];
}
