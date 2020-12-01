<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
                'name'     => 'Developer',
                'email'    => 'bks@exyplis.com',
                'password' => 'password',
                'role_id'  => 'admin',
            ]);
        } catch (\Throwable $exception){
            $this->command->info('Local user has already exists');
        }
    }
}
