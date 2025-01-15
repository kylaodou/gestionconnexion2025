@include('partials.header')

<body>
    @include('partials.sidebar')

    <!-- MAIN -->
    <main>
        <div class="head-title">
            <div class="left">
                <h1>Tableau de bord</h1>
                <ul class="breadcrumb">
                    <li>
                        <a href="#">Tableau de bord</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="/ajout_etudiant">Ajouter un utilisateur</a>
                    </li>
                </ul>
            </div>

            {{-- <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download'></i>
					<span class="text">Download PDF</span>
				</a> --}}
        </div>

        <div style="width: 60%;box-shadow: rgba(0, 0, 0, 0.09) 0px 3px 12px; margin: 0 auto;">
            <form action="/inscriptionTraitement" method="POST">
                @csrf
                <div style="height: 20px;"></div>
                <h1 class="mb-4">Ajouter un utilisateur</h1>
                <div style="height: 20px;"></div>
                <label></label>
                <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom"
                    value="{{ old('nom') }}" placeholder="Nom">
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label></label>
                <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom"
                    value="{{ old('prenom') }}" placeholder="Prénom">
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
                    placeholder="Mot de passe" required value="12345678"/>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div style="height: 40px;"></div>
                <button type="submit">Ajouter</button>
                <div style="height: 20px;"></div>
            </form>

        </div>
        @include('partials.script')
        @if (session('status'))
        <script>
            Swal.fire({
                title: "Félicitation!",
                text: "L'étudiant à été ajouter avec succès",
                icon: "success",
                allowOutsideClick: false, // **Désactivation de la fermeture en cliquant en dehors**
                showConfirmButton: true, // **Affichage du bouton OK**
            });
        </script>
        @endif
        <!-- Script JavaScript -->
        <script src="js/script.js"></script>
        <!-- Bootstrap JS Bundle with Popper -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
