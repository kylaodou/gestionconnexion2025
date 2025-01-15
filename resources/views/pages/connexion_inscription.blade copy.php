@include('partials.header')

<body class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="container" id="container" style="width: 65%">
        <div class="form-container sign-up-container">
            <form action="/inscription" method="POST">
                @csrf
                <h1>Créer un compte</h1>
                <div style="height: 50px;"></div>
                <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom"
                    value="{{ old('nom') }}" required placeholder="Nom" />
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label></label>
                <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom"
                    value="{{ old('prenom') }}" required placeholder="Prenom" />
                @error('prenom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label></label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                    value="{{ old('email') }}" required placeholder="Email" />
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label></label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                    placeholder="Mot de passe" required />
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label></label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmpassword"
                    name="password_confirmation" required placeholder="Confirmer mot de passe" />
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div style="height: 40px;"></div>
                <button type="submit">Créer</button>
            </form>
        </div>

        <div class="form-container sign-in-container">
            <form action="/connexion" method="POST">
                @csrf
                <h1>Se connecter</h1>
                <div style="height: 50px;"></div>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    placeholder="Email" />
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label></label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    placeholder="Mot de passe" />
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div style="height: 40px;"></div>
                <button type="submit">Se connecter</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                </div>
                <div class="overlay-panel overlay-right">
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
