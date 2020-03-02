<div class="modal modal-login animated fadeInUpBig faster">
  <div class="form-container modal">
      <div class="user-form modal">
          <span @click="isModalLoginOpen = false" class="modal-login-close">X</span>
          <h3>Login</h3>
          <form method="POST" action="{{ route('login') }}">
              @csrf

              <div class="form-group">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="E-Mail">
                  @error('email')
                      <div class="alert-danger">{{ $message }}</div>
                  @enderror
              </div>

              <div class="form-group">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required
                  placeholder="Password">
                  @error('password')
                      <div class="alert-danger">{{ $message }}</div>
                  @enderror
              </div>

              <div class="form-group">
                  <button type="submit">Login</button>
              </div>

              <div class="form-group">
                  <span id="not-registered">Non sei registrato? Registrati qui!</span>
              </div>
          </form>
      </div>
  </div>
</div>
