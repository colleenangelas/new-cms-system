<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      
       \App\Models\User::factory(4)->create()->each(function($user){
        $user->posts()->save(Post::factory()->make());
            

         //  User::factory(10)->has(Post::factory())->create();
        });
    }
}