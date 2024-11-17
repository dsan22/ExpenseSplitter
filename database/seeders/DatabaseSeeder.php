<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Expense;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(20)->create();
        User::factory()->create([
            "email"=>"test@email.com",
            "password"=>"password"
        ]);

        $users=User::all();
        foreach ($users as $user) {
            $user->groups()->attach(
                Group::factory(3)->create()
            );
        }
        $groups=Group::all();

        foreach ($groups as $group) {
            $randomUsers = User::inRandomOrder()  // Randomly order the users
                                ->whereNotIn('id', $group->users->pluck('id'))  // Exclude users already in the group
                                ->limit(5)  // Limit to 5 users
                                ->pluck('id');  // Get just the user IDs
        
            // Attach the selected random users to the group in one call
            $group->users()->attach($randomUsers);
            Expense::factory(10)->create([
                'group_id' => $group->id,  // Associating each expense with the group
                'user_id' => function () use ($randomUsers) {
                    return $randomUsers->random();
                },
            ]);
        };  
    }
}
