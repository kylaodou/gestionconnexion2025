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
                        <a class="active" href="/ajout_appareil">Ajouter un appareil</a>
                    </li>
                </ul>
            </div>

            {{-- <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download'></i>
					<span class="text">Download PDF</span>
				</a> --}}
        </div>

        <div style="width: 60%;box-shadow: rgba(0, 0, 0, 0.09) 0px 3px 12px; margin: 0 auto;">
            <form action="/ajout_appareilTraitement" method="POST">
                @csrf
                <div style="height: 20px;"></div>
                <h1 class="mb-4">Ajouter un appareil</h1>
                <div style="height: 20px;"></div>
                <label></label>
                <input type="text" class="form-control @error('adresse_mac') is-invalid @enderror" id="adresse_mac"
                    name="adresse_mac" value="{{ old('adresse_mac') }}" placeholder="Adresse MAC">
                @error('adresse_mac')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <label></label>
                <input type="text" class="form-control @error('marque') is-invalid @enderror" id="marque"
                    name="marque" value="{{ old('marque') }}" placeholder="Marque">
                @error('marque')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <select class="form-select form-select-lg mb-3 @error('type_appareil') is-invalid @enderror"
                    aria-label="Large select example" name="type_appareil" id="type_appareil">
                    <option value="">Choisisser le type d'appareil</option>
                    <option value="Ordinateur" {{ old('type_appareil') == 'Ordinateur' ? 'selected' : '' }}>Ordinateur
                    </option>
                    <option value="Smartphone" {{ old('type_appareil') == 'Smartphone' ? 'selected' : '' }}>Smartphone
                    </option>
                    <option value="Tablette" {{ old('type_appareil') == 'Tablette' ? 'selected' : '' }}>Tablette
                    </option>
                </select>
                @error('type_appareil')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <div class="row" style="width: 100%">
                    <label class="col-sm-2 col-form-label" style="font-size: 22px">Attribué à</label>
                    <div class="col-sm-10 d-flex align-items-center">
                        <div class="form-check form-check-inline" style="font-size: 20px; margin-left:20px">
                            <input class="form-check-input @error('user_type') is-invalid @enderror" type="radio"
                                name="user_type" id="etudiant_radio" value="etudiant" onclick="toggleUserType()"
                                checked>
                            <label class="form-check-label" for="etudiant_radio">Étudiant</label>
                        </div>
                        <div class="form-check form-check-inline" style="font-size: 20px">
                            <input class="form-check-input @error('user_type') is-invalid @enderror" type="radio"
                                name="user_type" id="personnel_radio" value="personnel" onclick="toggleUserType()">
                            <label class="form-check-label" for="personnel_radio">Personnel</label>
                        </div>
                    </div>
                </div>
                @error('user_type')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <div id="etudiant_section" style="width: 100%">
                    <select class="form-select form-select-lg mb-3 @error('etudiant') is-invalid @enderror"
                        name="etudiant" id="etudiant">
                        <option value="">Choisisser l'étudiant</option>
                        @foreach ($etudiants as $etudiant)
                            <option value="{{ $etudiant->INE }}"
                                {{ old('etudiant') == $etudiant->INE ? 'selected' : '' }}>
                                {{ $etudiant->INE }} - {{ $etudiant->personne->nom }} {{ $etudiant->personne->prenom }}
                            </option>
                        @endforeach
                    </select>
                    @error('etudiant')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                    @enderror
                </div>

                <div id="personnel_section" style="display: none; width:100%">
                    <select class="form-select form-select-lg mb-3 @error('personnel') is-invalid @enderror"
                        name="personnel" id="personnel">
                        <option value="">Choisisser le personnel</option>
                        @foreach ($personnels as $personnel)
                            <option value="{{ $personnel->id_personnel }}"
                                {{ old('personnel') == $personnel->id_personnel ? 'selected' : '' }}>
                                {{ $personnel->id_personnel }} - {{ $personnel->personne->nom }} {{ $personnel->personne->prenom }}
                            </option>
                        @endforeach
                    </select>
                    @error('personnel')
                        <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                    @enderror
                </div>

                <select class="form-select form-select-lg mb-3 @error('connexion') is-invalid @enderror"
                    name="connexion" id="connexion">
                    <option value="">Choisisser la connexion atribué</option>
                    @foreach ($connexions as $connexion)
                        <option value="{{ $connexion->id }}"
                            {{ old('connexion') == $connexion->id ? 'selected' : '' }}>
                            {{ $connexion->nom }}
                        </option>
                    @endforeach
                </select>
                @error('connexion')
                    <div class="invalid-feedback" style="display: block;">{{ $message }}</div>
                @enderror

                <div style="height: 20px;"></div>
                <button type="submit">Créer</button>
                <div style="height: 20px;"></div>
            </form>

        </div>
        <script>
            function toggleUserType() {
                const etudiantSection = document.getElementById('etudiant_section');
                const personnelSection = document.getElementById('personnel_section');

                if (document.getElementById('etudiant_radio').checked) {
                    etudiantSection.style.display = 'block';
                    personnelSection.style.display = 'none';
                } else {
                    etudiantSection.style.display = 'none';
                    personnelSection.style.display = 'block';
                }
            }

            // Initial call to set the correct display on page load
            toggleUserType();
        </script>

        <!-- Script JavaScript -->
        <script src="js/script.js"></script>
        @include('partials.script')
        @if (session('success'))
            <script>
                Swal.fire({
                    title: "Félicitation!",
                    text: "L'appareil à été ajouter avec succès",
                    icon: "success",
                    allowOutsideClick: false, // **Désactivation de la fermeture en cliquant en dehors**
                    showConfirmButton: true, // **Affichage du bouton OK**
                });
            </script>
        @endif
        <!-- Bootstrap JS Bundle with Popper -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
