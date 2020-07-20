<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SentEmail extends Model
{
    protected $fillable = ['aws_message_id', 'to_email_address', 'subject', 'message', 'delivered', 'bounced', 'complaint', 'opened'];
}
