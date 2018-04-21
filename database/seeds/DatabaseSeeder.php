<?php

use App\User;
use Illuminate\Database\Seeder;
use Symfony\Component\Yaml\Yaml;

class DatabaseSeeder extends Seeder
{

    const RECIPES = __DIR__ . '/../../recipes.yaml';

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        /** @var User $user */
        $user = User::create([
            'name' => 'Logan Bailey',
            'email' => 'logan@logansbailey.com',
            'password' => password_hash('password', PASSWORD_DEFAULT)
        ]);


        $recipes = Yaml::parse(file_get_contents(self::RECIPES));
        foreach ($recipes as $recipe_data) {
            $user->recipes()->create($recipe_data);
        }

    }
}
