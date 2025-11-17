<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sydneyAddresses = [
            [
                'street' => '123 George Street',
                'suburb' => 'Sydney',
                'postcode' => '2000',
                'state' => 'NSW'
            ],
            [
                'street' => '456 Pitt Street',
                'suburb' => 'Sydney',
                'postcode' => '2000',
                'state' => 'NSW'
            ],
            [
                'street' => '789 Castlereagh Street',
                'suburb' => 'Sydney',
                'postcode' => '2000',
                'state' => 'NSW'
            ],
            [
                'street' => '321 Market Street',
                'suburb' => 'Sydney',
                'postcode' => '2000',
                'state' => 'NSW'
            ],
            [
                'street' => '654 Elizabeth Street',
                'suburb' => 'Sydney',
                'postcode' => '2000',
                'state' => 'NSW'
            ],
            [
                'street' => '12 Darling Harbour Road',
                'suburb' => 'Darling Harbour',
                'postcode' => '2000',
                'state' => 'NSW'
            ],
            [
                'street' => '45 The Rocks Road',
                'suburb' => 'The Rocks',
                'postcode' => '2000',
                'state' => 'NSW'
            ],
            [
                'street' => '78 Circular Quay',
                'suburb' => 'Circular Quay',
                'postcode' => '2000',
                'state' => 'NSW'
            ],
            [
                'street' => '23 Martin Place',
                'suburb' => 'Sydney',
                'postcode' => '2000',
                'state' => 'NSW'
            ],
            [
                'street' => '56 Barangaroo Avenue',
                'suburb' => 'Barangaroo',
                'postcode' => '2000',
                'state' => 'NSW'
            ],
            [
                'street' => '89 Kent Street',
                'suburb' => 'Sydney',
                'postcode' => '2000',
                'state' => 'NSW'
            ],
            [
                'street' => '34 Clarence Street',
                'suburb' => 'Sydney',
                'postcode' => '2000',
                'state' => 'NSW'
            ],
            [
                'street' => '67 York Street',
                'suburb' => 'Sydney',
                'postcode' => '2000',
                'state' => 'NSW'
            ],
            [
                'street' => '90 King Street',
                'suburb' => 'Sydney',
                'postcode' => '2000',
                'state' => 'NSW'
            ],
            [
                'street' => '11 Macquarie Street',
                'suburb' => 'Sydney',
                'postcode' => '2000',
                'state' => 'NSW'
            ],
            [
                'street' => '22 Bridge Street',
                'suburb' => 'Sydney',
                'postcode' => '2000',
                'state' => 'NSW'
            ],
            [
                'street' => '33 Phillip Street',
                'suburb' => 'Sydney',
                'postcode' => '2000',
                'state' => 'NSW'
            ],
            [
                'street' => '44 Margaret Street',
                'suburb' => 'Sydney',
                'postcode' => '2000',
                'state' => 'NSW'
            ],
            [
                'street' => '55 Hunter Street',
                'suburb' => 'Sydney',
                'postcode' => '2000',
                'state' => 'NSW'
            ],
            [
                'street' => '66 Park Street',
                'suburb' => 'Sydney',
                'postcode' => '2000',
                'state' => 'NSW'
            ]
        ];

        $firstNames = [
            'James', 'Mary', 'John', 'Patricia', 'Robert', 'Jennifer', 'Michael', 'Linda',
            'William', 'Elizabeth', 'David', 'Susan', 'Richard', 'Jessica', 'Joseph', 'Sarah',
            'Thomas', 'Karen', 'Charles', 'Nancy', 'Christopher', 'Lisa', 'Daniel', 'Margaret',
            'Matthew', 'Betty', 'Anthony', 'Sandra', 'Mark', 'Ashley'
        ];

        $lastNames = [
            'Smith', 'Johnson', 'Williams', 'Brown', 'Jones', 'Garcia', 'Miller', 'Davis',
            'Rodriguez', 'Martinez', 'Hernandez', 'Lopez', 'Gonzalez', 'Wilson', 'Anderson',
            'Thomas', 'Taylor', 'Moore', 'Jackson', 'Martin', 'Lee', 'Perez', 'Thompson',
            'White', 'Harris', 'Sanchez', 'Clark', 'Ramirez', 'Lewis', 'Robinson'
        ];

        $domains = ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com', 'bigpond.com', 'optusnet.com.au'];

        foreach (range(1, 20) as $index) {
            $firstName = $firstNames[array_rand($firstNames)];
            $lastName = $lastNames[array_rand($lastNames)];
            $email = strtolower($firstName . '.' . $lastName . rand(1, 999) . '@' . $domains[array_rand($domains)]);
            $address = $sydneyAddresses[$index - 1];

            $phone = '04' . rand(10, 99) . ' ' . rand(100, 999) . ' ' . rand(100, 999);

            $customer = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'phone' => $phone,
                'password' => Hash::make('password123'),
                'country' => 'Australia',
                'city' => $address['suburb'],
                'state' => $address['state'],
                'postal_code' => $address['postcode'],
                'address' => $address['street'] . ', ' . $address['suburb'] . ', ' . $address['state'] . ' ' . $address['postcode'],
                'gender' => ['male', 'female'][rand(0, 1)],
                'dob' => now()->subYears(rand(20, 60))->subDays(rand(0, 365))->format('Y-m-d'),
                'role' => 'customer',
                'username' => Str::slug($firstName . '-' . $lastName . '-' . Str::random(4)),
                'is_active' => rand(0, 1),
                'email_verified_at' => rand(0, 1) ? now() : null,
                'created_at' => now()->subDays(rand(1, 365)),
                'updated_at' => now()->subDays(rand(1, 365)),
            ]);

            $this->command->info("Created customer: {$customer->first_name} {$customer->last_name} - {$customer->email}");
        }

        $this->command->info('Successfully created 20 customers with Sydney addresses!');
    }
}
