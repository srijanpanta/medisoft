<?php

namespace App\Services;

class Newsletter
{
    public function subscribe($email,string $list=null)
    {
        $list??=config('services.mailchimp.lists.subscribers');
        return $this->client()->lists->addListMember($list,[
            'email_address'=>$email,
            'status'=>'subscribed'
    ]);
    }

    protected function client()
    {
        $mailchimp = new \MailchimpMarketing\ApiClient();
        return $mailchimp->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us20'
        ]);
    }
}
?>  