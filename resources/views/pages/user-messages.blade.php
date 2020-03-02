@extends('layouts.base')

@section('main')
<div class="home"></div>
<div class="sponsor-title">
    <p class="animated bounceInRight">Messaggi</p>
    <h1 class="animated bounceInLeft">
        Visualizza i messaggi dei tuoi appartamenti
    </h1>
</div>
<div class="previews_container">
    @if (count($messages) != 0)
    @foreach ($messages as $message)
    <div class="message-preview">
        <div class="img_card">
            <img src="{{ Storage::disk('public')->exists($message -> apartment -> image) ? Storage::url($message -> apartment -> image) : $message -> apartment -> image }}" alt="">
        </div>
        <div class="text">
            <p>
                <a href="{{ route('show-apartment', $message -> apartment -> id) }}">{{$message -> apartment -> title }}</a>
            </p>
            <p>
                Da: {{ $message -> mail }}
            </p>
            <div class="message-body">
                <p class="content">{{ $message -> content}}</p>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <div class="no-messages">
        <h1>Non hai nessun messaggio</h1>
    </div>
    @endif
</div>
@endsection
