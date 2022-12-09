<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Passport;

class LoginUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:login {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Oauth token for user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Login...');
        Passport::tokensExpireIn(now()->addMinutes(5));

        $auth = Auth::attempt([
            'email'     => $this->argument('email'),
            'password'  => $this->argument('password')
        ]);

        if (!$auth) {
            $this->error('Incorrect credentials');
        }

        /**
         * @var \Laravel\Passport\HasApiTokens $user
         */
        $user  = Auth::user();
        $token = $user->createToken('authToken')->accessToken;
        $this->info('Token: ' . $token);
        return Command::SUCCESS;
    }
}
