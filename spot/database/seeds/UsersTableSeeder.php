<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$a = ['aaa', 'bbb', 'ccc', 'ddd', 'eee', 'fff', 'ggg', 'hhh', 'iii', 'jjj'];
        $now = \Carbon\Carbon::now();
        for($i = 0; $i < 10; $i++){
        	$users = [
            'name' => $a[$i],
            'email' => $a[$i].'@'.$a[$i].'.'.$a[$i],
            'password' => password_hash($a[$i].$a[$i], PASSWORD_BCRYPT),
            'created_at' => $now,
            'updated_at' => $now
        	];
        	DB::table('users')->insert($users);
        }
    }
}
