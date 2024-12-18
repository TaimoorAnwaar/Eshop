{{-- resources/views/messages/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Messages')

@section('content')
<div class="container py-5">
    <h1 class="display-4 mb-4">Your Messages</h1>

    @if($messages->isEmpty())
        <p class="lead">You have no messages yet.</p>
    @else
        <div class="list-group">
            @foreach($messages as $message)
                <div class="list-group-item">
                    <strong>
                        {{ $message->sender_id == auth()->id() ? 'You' : $message->sender->name }}:
                    </strong>
                    <p>{{ $message->text }}</p>
                    <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
