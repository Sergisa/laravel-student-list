@extends('layout')
@section('title', 'HomePage')
@section('content')
    <div class="max-w-7xl mx-auto p-6 lg:p-8 text-blue-600">
        @foreach ($logs as $log)
            <p>LOG:  {{ $log->computer_name }}</p>
        @endforeach
    </div>
@endsection
