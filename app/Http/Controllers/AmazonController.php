<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SentEmail;
use Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\Aws;


class AmazonController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'to_email_address' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $data = $request->all();

        $headers = "";
        Mail::send('email.aws', ['data' => $data], function ($message) use (&$headers, $request) {
            $message->to($request->to_email_address)->subject($request->subject);
            $headers = $message->getHeaders();
        });

        $message_id = $headers->get('X-SES-Message-ID')->getValue();
        Log::info($message_id);
        if ($message_id){
            $sentEmail = new SentEmail;
            $sentEmail->to_email_address = $request->to_email_address;   
            $sentEmail->subject = $request->subject;   
            $sentEmail->message = $request->message;   
            $sentEmail->aws_message_id = $message_id;   
            $sentEmail->save();    
            return redirect('/sent_emails')->with('success','Email Sent');
        }
        

    }

    public function emailNotifications(Request $request)
    {
        Log::info(request()->json()->all());
        $data = $request->json()->all();

        if ($data['Type'] == 'SubscriptionConfirmation'){
            file_get_contents($data['SubscribeURL']);
        } elseif ($data['Type'] == 'Notification'){
            $message = json_decode($data['Message'], true);
            Log::info($message);
            if ($message == 'test'){
                return response('OK', 200);
            }
            $message_id = $message['mail']['messageId'];
            switch($message['eventType']){
            case 'Bounce':
                $bounce = $message['bounce'];
                $email = SentEmail::where('aws_message_id', $message_id)->first();
                $email->bounced = true;
                $email->save();
                // foreach ($bounce['bouncedRecipients'] as $bouncedRecipient){
                //     $emailAddress = $bouncedRecipient['emailAddress'];
                //     $emailRecord = WrongEmail::firstOrCreate(['email' => $emailAddress, 'problem_type' => 'Bounce']);
                //     if($emailRecord){
                //         $emailRecord->increment('repeated_attempts',1);
                //     }
                // }
            break;
            case 'Complaint':
                $complaint = $message['complaint'];
                $email = SentEmail::where('aws_message_id', $message_id)->first();
                $email->complaint = true;
                $email->save();
                // foreach($complaint['complainedRecipients'] as $complainedRecipient){
                //     $emailAddress = $complainedRecipient['emailAddress'];
                //     $emailRecord = WrongEmail::firstOrCreate(['email' => $emailAddress, 'problem_type' => 'Complaint']);
                //     if($emailRecord){
                //         $emailRecord->increment('repeated_attempts',1);
                //     }
                // }
            break;
            case 'Open':
                $open = $message['open'];
                $email = SentEmail::where('aws_message_id', $message_id)->first();
                $email->opened = true;
                $email->save();
            break;
            case 'Delivery':
                $delivery = $message['delivery'];
                $email = SentEmail::where('aws_message_id', $message_id)->first();
                $email->delivered = true;
                $email->save();
            break;  
            default:
            // Do Nothing
            break;
            }
          }
        
        return response('OK', 200);
    }
}
