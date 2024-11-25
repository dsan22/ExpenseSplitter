<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function groups(){
        return $this->belongsToMany(Group::class);
    }

    public function calculateUserPaymentForGroup(Group $group){
        $membersCount = $group->users()->count();
        $expenses = $group->expenses;
        $payment = $expenses->map(function ($expense)use( $membersCount) {
            if ($expense->expenseShares()->doesntExist()) {
                return $expense->getTotalPrice() / $membersCount;
            }
            $usersShare = $expense->expenseShares()
            ->where('user_id',$this->id)
            ->first();
            if($usersShare){
                return $usersShare->calculateUserPayment();
            }else{
               return 0;
            }
        })->sum();

        return round($payment,2);
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
