<div class="modal modal-register animated fadeInUpBig faster">
    <div class="form-container modal">
        <div class="user-form modal">
            <span @click="isModalRegisterOpen = false" class="modal-register-close">X</span>
            <h3>Registrati</h3>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nome">

                    @error('name')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" placeholder="Cognome">

                    @error('surname')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="birth" max="2020-02-13" class="form-control @error('birth') is-invalid @enderror" name="birth" value="{{ old('birth') }}" onfocus="(this.type='date')" placeholder="Data di nascita">

                    @error('birth')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-Mail" required>

                    @error('email')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required>

                    @error('password')
                    <div class="alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Conferma Password" required>
                </div>

                <div class="form-group">
                    <span class="">I campi contrassegnati con * sono obbligatori</span>
                </div>

                <div class="form-group">
                    <button type="submit">Registrati</button>
                </div>
            </form>
        </div>
    </div>
</div>
