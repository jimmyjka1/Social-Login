@extends('beautymail::templates.ark')

@section('content')

    @include('beautymail::templates.ark.heading', [
        'heading' => 'Welcome to Social Login',
        'level' => 'h1'
    ])

    @include('beautymail::templates.ark.contentStart')

        <h4 class="secondary"><strong>Welcome</strong></h4>
        <p>Thank You from registering</p>

    @include('beautymail::templates.ark.contentEnd')

    @include('beautymail::templates.ark.heading', [
        'heading' => 'Please Verify your account',
        'level' => 'h2'
    ])

    @include('beautymail::templates.ark.contentStart')

        <h4 class="secondary"><strong>Hsn</strong></h4>
        <p>This is another test</p>

    @include('beautymail::templates.ark.contentEnd')

@stop