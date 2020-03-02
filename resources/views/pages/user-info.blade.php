@extends('layouts.base')

@section('script')

  <script type="text/javascript" src="{{mix('js/avatar.js')}}">

  </script>

@endsection

@section('main')
  <div class="container-info">
    <div class="user-info">
      <h1>Account Information</h1>
      <div class="image">
        <img id="avatar" src="{{Storage::url(Auth::user() -> avatar)}}" alt="" width="200" height="200">
      </div>
      <div class="data">
        <form action="{{ route('set-avatar', Auth::id())}}" method="post" enctype="multipart/form-data">
          @csrf
          @method('POST')
          <input type="file" name="avatar" value="" id="imgInp">
          <input type="submit" name="" value="Salva">
        </form>

        <p><strong>Nome:</strong> {{ Auth::user() -> name }}</p>
        <p><strong>Email:</strong> {{ Auth::user() -> email }}</p>
        <p><strong>Appartamenti registrati:</strong> {{ Auth::user() -> apartments() -> count() }}</p>
      </div>
    </div>
  </div>

@endsection
