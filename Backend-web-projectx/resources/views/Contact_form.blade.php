@extends('layouts.app')




@section('content')

<div class="container">
    <h1>Contact Form</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form action="{{ route('contact.send') }}" method="POST">
        @csrf
        @method('POST')
        <div class="form-group">    
            <label for="name">Name</label>
            <input type="text" name="name" placeholder="Name">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="email_message" placeholder="email_message"></textarea>
        </div>
        <button type="submit">Send</button>
    </form>

</div>  

@endsection
