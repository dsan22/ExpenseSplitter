<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseShare extends Model
{
    use HasFactory;

    public function expense(){
        return $this->belongsTo(Expense::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function calculatePortion(){
        $expense = $this->expense; 
        $totalWeight = $expense->expenseShares->sum('weight'); 
        $userWeightPortion = $this->weight / $totalWeight; 
        return $userWeightPortion;
    }
    public function calculateUserPayment(){
        $userWeightPortion = $this->calculatePortion(); 
        return $this->expense->getTotalPrice() * $userWeightPortion; 
    }
    protected $guarded=["id"];
}
