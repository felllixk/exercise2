<?php

namespace App\Console\Commands;

use App\Modules\Common\Controllers\UserController;
use App\Modules\Common\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Creating user...');

        $validator = Validator::make([
            'email' => $this->argument('email'),
            'password' => $this->argument('password'),
        ], [
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8'],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return Command::FAILURE;
        }

        $credentials = $validator->validated();
        $user = new User();
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);
        $user->save();

        $this->info('Success');
        return Command::SUCCESS;
    }
}
