<?php

namespace Database\Seeders;

use App\Models\Email;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class SuccessfulEmailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i <= 10; $i++) {
            Email::query()->create([
                'affiliate_id' => $faker->numberBetween(1, 100),
                'envelope' => json_encode(['from' => $faker->email, 'to' => $faker->email]),
                'from' => $faker->email,
                'subject' => $faker->sentence,
                'dkim' => $faker->regexify('[A-Za-z0-9]{10}'),
                'SPF' => $faker->regexify('[A-Za-z0-9]{10}'),
                'spam_score' => $faker->randomFloat(2, 0, 1),
                'email' => "Full raw email content for email $i with headers and body.",
                'raw_text' => "Plain text content for email $i.",
                'sender_ip' => $faker->ipv4,
                'to' => $faker->email,
                'timestamp' => now()->timestamp,
                'is_processed' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
