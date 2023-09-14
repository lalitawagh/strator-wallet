<?php

namespace Kanexy\LedgerFoundation\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WalletStripeDepositEmail extends Mailable
{
    use Queueable, SerializesModels;


    public $user;
    public $wallet;
    public $amount;
    public $depositFrom;
    public $depositTo;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $wallet,$amount,$depositFrom,$depositTo)
    {
        $this->user = $user;
        $this->wallet = $wallet;
        $this->amount = $amount;
        $this->depositFrom = $depositFrom;
        $this->depositTo = $depositTo;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Stripe Deposit Confirmation ',
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
            markdown: 'ledger-foundation::wallet.emails.stripeDeposit',
            with:[
                'customerFirstName' => $this->user->first_name,
                'customerMiddleName' => $this->user->middle_name,
                'customerLastName' => $this->user->last_name,
                'walletName' => $this->wallet->name,
                'amount' => $this->amount,
                'depositFrom' => $this->depositFrom,
                'depositTo' => $this->depositTo,
            ],
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
