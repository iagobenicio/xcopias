<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $data = [
            "name"=>"administrador",
            "user"=>"xadmincopiasif",
            "password"=>bcrypt("x.if@43445656"),
            "type"=>1,
            "copiasmes"=>0,
            "copiasrestante"=>0,
        ];
        User::create($data);
    }
}
