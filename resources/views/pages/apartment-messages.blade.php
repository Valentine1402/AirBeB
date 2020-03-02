@extends('layouts.base')

@section('main')
  <div class="previews_container">
    @if (count($messages) != 0)
      <h1>Hai {{ count($messages) }} nuovi messaggi!</h1>
      @foreach ($messages as $message)
        <div data-message="{{ $message -> id }}" class="message-preview">
          <div class="text">
            <div class="header">
              <p class="from">
                Da: {{ $message -> mail }}
              </p>
            </div>
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
