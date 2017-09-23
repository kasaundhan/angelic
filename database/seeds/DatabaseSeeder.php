<?php
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
	
		$user =  new User;
		$user->name= 'testing';
		$user->email= 'testing@test.com';
		$user->password= bcrypt('testing');
		$user->save();
		
    }
}
