<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $gender = ['male', 'female'];
        $gender = $gender[rand(0,1)];

        return [
            'firstName'  => $this->faker->firstName($gender),
            'secondName'  => $this->faker->lastName($gender),
            'middleName'  => $this->faker->middleName($gender),
            'phone'  =>  $this->faker->phoneNumber,
            'date' => $this->faker->dateTimeInInterval('-180 days', '+360 days')
        ];
    }
}
