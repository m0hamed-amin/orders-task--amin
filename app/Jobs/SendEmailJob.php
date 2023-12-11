<?php

namespace App\Jobs;

use App\Mail\AlertEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $ingredient_name;

    protected $send_mail;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $ingredient_name,mixed $send_mail)
    {
        $this->ingredient_name = $ingredient_name;
        $this->send_mail = $send_mail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new AlertEmail();
        Mail::to($this->send_mail)->send($email);
    }
}
