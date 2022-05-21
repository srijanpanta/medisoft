<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phoneNumber' => $this->faker->numerify('##########'),
            'remember_token' => Str::random(10),
            'role'=>'patient',
            'image'=>'sampleProfile.jpeg',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
    public function doctor()
    {
        return $this->state(function ($faker) {
            return [
                'role' => 'doctor',
                'nmc_no' => $this->faker->unique()->numberBetween(1000,20000),
                'doctor_degree' => $this->faker->randomElement(['MBBS', 'MD', 'BDS', 'MS']),
                'doctor_type'=>$this->faker->randomElement(['Ear, Nose and Throat', 'General Surgery', 'Ophthalmology', 'Orthopaedics', 'Obstetrics and Gynaecology', 'Pharmacology', 'Physiology', 'Radio-Therapy', 'Physician', 'Cardiology', 'Paediatrics', 'Nephrology', 'Neurology']),
            ];
        });
    }  
}
