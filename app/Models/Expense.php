<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    public function group(){
        return $this->belongsTo(Group::class);
    }
    public function added_by(){
        return $this->belongsTo(User::class,"user_id");
    }
    public function expenseShare(){
        return $this->hasMany(ExpenseShare::class);
    }


    protected $guarded=["id"];
}
