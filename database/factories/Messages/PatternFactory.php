<?php

namespace Database\Factories\Messages;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Messages\Pattern;
use Illuminate\Support\Collection;

class PatternFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pattern::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'theme'      => $this->faker->word,
            'sms_text'   => $this->faker->text,
            'viber_text' => $this->faker->text,
            'tag'        => $this->faker->word,
        ];
    }
}
