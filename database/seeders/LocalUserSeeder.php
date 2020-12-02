<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LocalUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try{
          User::create([
                'name'           => 'Developer',
                'email'          => 'bks@exyplis.com',
                'password'       => 'password',
                'role_id'        => 'admin',
                'remember_token' => Str::random(10),
              ]);
        } catch (\Throwable $exception){
            $this->command->info('Local user has already exists');
        }
    }
}
