<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Districts;
use App\Models\User;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'reportName' => $this->faker->text(10),
            'reportDescription' => $this->faker->text(200),
            'diseaseName' =>  $this->faker->randomElement(['Allergies', 'Colds and Flu', 'Conjunctivitis', 'Diarrhea', 'Headaches', 'Mononucleosis', 'Stomach Aches', 'Covid', 'Kidney Stone', 'Diabetes', 'Depression', 'Anxiety', 'Hemorrhoid', 'Yeast infection', 'Lupus', 'Shingles', 'Psoriasis', 'Schizophrenia', 'Lyme disease', 'HPV', 'Herpes', 'Pneumonia', 'Fibromyalgia', 'Scabies', 'Chlamydia', 'Endometriosis', 'Strep throat', 'Diverticulitis', 'Bronchitis']),
            'reportImage'=>'sampleReport.png',
            'location'=> Districts::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
