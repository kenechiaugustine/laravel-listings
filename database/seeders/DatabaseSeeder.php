<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Listings;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'name' => 'Kenny G',
            'email' => 'kenechiaugustine@gmail.com',
            'password' => bcrypt('password')
        ]);

        // Listings::factory(3)->create([
        //     'user_id' => $user->id
        // ]);
        
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Listings::create([
        //     'title' => 'Laravel Senior Developer',
        //     'tags' => 'laravel, javascript',
        //     'company' => 'Acme Corp',
        //     'address' => 'NO 4b Nike',
        //     'location' => 'Boston, MA',
        //     'email' => 'email@example.com',
        //     'website' => 'https://www.acme.com',
        //     'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis maiores natus aspernatur eveniet quisquam dignissimos consequuntur laudantium perspiciatis, magni, vitae accusamus veritatis quis fugit ullam, repudiandae dolores iusto soluta qui?'
        // ]);

        // Listings::create([
        //     'title' => 'Laravel Senior Developer',
        //     'tags' => 'laravel, javascript',
        //     'company' => 'Acme Corp',
        //     'address' => 'NO 4b Nike',
        //     'location' => 'Boston, MA',
        //     'email' => 'email@example.com',
        //     'website' => 'https://www.acme.com',
        //     'description' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corporis maiores natus aspernatur eveniet quisquam dignissimos consequuntur laudantium perspiciatis, magni, vitae accusamus veritatis quis fugit ullam, repudiandae dolores iusto soluta qui?'
        // ]);
    }
}
