<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateOwnerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:owner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command creates an owner user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if(!Role::where('name', 'owner')->first()){
            Artisan::call('db:seed', ['--class' => 'RoleAndPermissionSeeder']);
        }

        $name = $this->ask('What is the owner name?');
        $email = $this->ask('What is the owner email?');
        $password = $this->ask('What is the owner password?');

        $validator = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password
        ], [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails()){
            foreach($validator->errors()->all() as $error){
                $this->error($error);
            }
            return;
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'account_verified_at' => now(),
            'password' => Hash::make($password),
            'otp' => rand(100000, 999999)
        ]);

        $ownerRole = Role::where('name', 'owner')->first();
        $user->roles()->attach($ownerRole->id);

        $this->info('Owner '. $name .' created successfully');
    }
}
