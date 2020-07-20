@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Sent Emails</div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>Email</td>
                            <td>Subject</td>
                            <td>Message</td>
                            <td>Delivered</td>
                            <td>Opened</td>
                            <td>Bounced</td>
                            <td>Complaint</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sent_emails as $email)
                        <tr>
                            <td>{{$email->to_email_address}}</td>
                            <td>{{$email->subject}}</td>
                            <td>{{$email->message}}</td>
                            <td>{{$email->delivered ? "Yes" : "No"}}</td>
                            <td>{{$email->opened ? "Yes" : "No"}}</td>
                            <td>{{$email->bounced ? "Yes" : "No"}}</td>
                            <td>{{$email->complaint ? "Yes" : "No"}}</td>
                            {{-- <td>{{$email->date->format('d-m-Y')}}</td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {!! $sent_emails->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection