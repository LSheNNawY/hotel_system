<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin  {--name=} {--password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create admin';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(User $user)
    {
        $email = $this->option("name");
        $password = $this->option("password");

        $user->name = $email;
        $user->email = $email;
        $user->password = Hash::make($password);

        $user->save();
    }
}
