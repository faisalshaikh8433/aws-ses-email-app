@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Send Email</div>
            <form action="{{ route('send_email') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="label-control">Name</label>
                        <input type="text" id="name" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="to_email_address" class="label-control">Email Address</label>
                        <select name="to_email_address" id="to_email_address" class="form-control">
                            <option value="aditya.leadzpipe@gmail.com">aditya.leadzpipe@gmail.com</option>
                            <option value="diwali.leadfactory@gmail.com">diwali.leadfactory@gmail.com</option>
                            <option value="faisal.leadzpipe@gmail.com">faisal.leadzpipe@gmail.com</option>
                            <option value="bounce@simulator.amazonses.com">bounce@simulator.amazonses.com</option>
                            <option value="info@app.leadzpipe.com">info@app.leadzpipe.com</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subject" class="label-control">Subject</label>
                        <input type="text" id="subject" class="form-control" name="subject">
                    </div>
                    <div class="form-group">
                        <label for="message" class="label-control">Message</label>
                        <textarea name="message" id="message" class="form-control" cols="0" rows="5"></textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection