<?php

namespace App\Mail;

use App;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Expense;

class UsersPaymentConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    
    public $group;
    public $expensesStorage;
    public $user;

    public function __construct($group, $user)
    {
        $this->group = $group;
        $this->user = $user;
        $membersCount = $group->users()->count();
        $this->expensesStorage  = new \SplObjectStorage();
        foreach($this->group->expenses as $expense){
            if ($expense->expenseShares()->doesntExist()) {
                $this->expensesStorage[$expense] = $expense->getTotalPrice() / $membersCount;
                continue;
            }
        
            $usersShare = $expense->expenseShares()
                ->where('user_id', $user->id)
                ->first();
        
            if ($usersShare) {
                $this->expensesStorage[$expense] = $usersShare->calculateUserPayment();
            } else {
                $this->expensesStorage[$expense] = 0;
            }
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your payment confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.users_payment_confirmation',
            with: [
                'group' => $this->group,
                'expenses' => $this->expensesStorage,
                'user' => $this->user
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
