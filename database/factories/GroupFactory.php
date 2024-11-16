<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    private $events = [
        'Family Picnic in the Park',
        'Outdoor Movie Night',
        'Game Night at Home',
        'Road Trip to a Nearby City',
        'Beach Day',
        'Visit to a Museum',
        'Bowling Night',
        'Camping Trip',
        'Farmers Market Visit',
        'Amusement Park Adventure',
        'Zoo Visit',
        'Concert in the Park',
        'Escape Room Challenge',
        'Barbecue Party',
        'Potluck Dinner',
        'Go-Kart Racing',
        'Mini Golf',
        'DIY Craft Day',
        'Cooking Class',
        'Food Festival',
        'Holiday Light Tour',
        'Ice Skating',
        'Skiing or Snowboarding Trip',
        'Volunteer for a Community Event',
        'Visit to an Aquarium',
        'Cooking or Baking Competition',
        'Trivia Night at a Pub',
        'Karaoke Night',
        'Horseback Riding',
        'Fishing Trip',
        'Paintball Match',
        'Scavenger Hunt',
        'Drive-In Movie',
        'Nature Hike',
        'Tree Planting Event',
        'Pottery or Art Class',
        'Photography Walk',
        'Music Festival',
        'Sports Game (Baseball, Basketball, etc.)',
        'Visit to a Historic Site',
        'Night at an Arcade',
        'DIY Home Project',
        'Board Game Marathon',
        'Holiday Craft Fair',
        'Cooking Dinner Together',
        'Visit a National Park',
        'Rock Climbing Adventure',
        'Swimming Pool Party',
        'Baking Cookies for Charity',
        'Trivia Contest at a Coffee Shop',
        'Night at a Comedy Club',
        'Attending a Local Play or Theater Show'
    ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->randomElement($this->events),
        ];
    }
}
