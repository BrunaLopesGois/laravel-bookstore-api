<?php

namespace App\Jobs;

use App\Mail\CheckoutMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $sendTo;

    protected array $mailContent;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $sendTo, array $mailContent)
    {
        $this->sendTo = $sendTo;
        $this->mailContent = $mailContent;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new CheckoutMail($this->mailContent);
        Mail::to($this->sendTo)->send($email);
    }
}
