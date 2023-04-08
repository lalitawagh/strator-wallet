<?php

namespace Kanexy\LedgerFoundation\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TransferCreditAlertEmail extends Mailable
{
    use Queueable, SerializesModels;


    public $user;
    public $creditTransaction;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user , $creditTransaction)
    {
        $this->user = $user;
        $this->creditTransaction = $creditTransaction;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Confirmation of Credit Transaction (Transfer)',

        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'ledger-foundation::wallet.emails.transferCredit',
            with:[
                'firstName'=>$this->user->first_name,
                'lastName'=>$this->user->last_name,
                'transactionAmount'=>$this->creditTransaction->amount,
                'transactionRefferenceNo'=>$this->creditTransaction->meta['reference'],
                'transactionDate'=>$this->creditTransaction->created_at->format('d-m-Y  H:i A')
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
