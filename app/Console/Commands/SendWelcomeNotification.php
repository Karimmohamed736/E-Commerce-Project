<?php

namespace App\Console\Commands;

use App\Jobs\SendWelocmeMailJob;
use App\Models\User;
use Illuminate\Console\Command;

class SendWelcomeNotification extends Command
{
    protected $signature = 'notify:send-welcome-notification {user_id}';

    protected $description = 'Send a welcome notification to a user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::findOrFail($this->argument('user_id'));
        dd($user);
        dispatch(new SendWelocmeMailJob($user)); // Dispatch the job to send the welcome email
        $this->info('Welcome notification sent to user: '.$user->email);
    }
}
