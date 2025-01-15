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
                        <a class="active" href="/ajout_connexion">Ajouter une connexion</a>
                    </li>
                </ul>
            </div>

            {{-- <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download'></i>
					<span class="text">Download PDF</span>
				</a> --}}
        </div>

        <div style="width: 60%;box-shadow: rgba(0, 0, 0, 0.09) 0px 3px 12px; margin: 0 auto;">
            <form action="/ajout_connexionTraitement" method="POST">
                @csrf
                <div style="height: 20px;"></div>
                <h1 class="mb-4">Ajouter une connexion</h1>
                <div style="height: 20px;"></div>
                <label></label>
                <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom"
                    value="{{ old('nom') }}" placeholder="Nom de la connexion">
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label></label>
                <input type="text" class="form-control @error('bande_passante') is-invalid @enderror" id="bande_passante" name="bande_passante"
                    value="{{ old('bande_passante') }}" placeholder="Bande passante">
                @error('bande_passante')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label></label>
                <input type="number" class="form-control @error('nbr_utilisateur') is-invalid @enderror" id="nbr_utilisateur" name="nbr_utilisateur"
                    value="{{ old('nbr_utilisateur') }}" placeholder="Nombre d'utilisateurs">
                @error('nbr_utilisateur')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <label></label>
                <input type="text" class="form-control @error('operateur') is-invalid @enderror" id="operateur" name="operateur"
                    value="{{ old('operateur') }}" placeholder="Opérateur">
                @error('operateur')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div style="height: 40px;"></div>
                <button type="submit">Créer</button>
                <div style="height: 20px;"></div>
            </form>

        </div>
        @include('partials.script')
        @if (session('status'))
        <script>
            Swal.fire({
                title: "Félicitation!",
                text: "La connexion à été ajouter avec succès",
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
