<?php


namespace Wr\Connect\CoreBundle\Status;


class NotifyUser
{

    protected $mailer;

    public function __construct( $mailer)
    {
        $this->mailer = $mailer;
    }

    public function notify(){
    }
}