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
                        <a class="active" href="/liste_etudiants">Liste des étudiants</a>
                    </li>
                </ul>
            </div>
            <span class="connexion">Toltal : {{ $etudiants->count() }} étudiants</span>

            {{-- <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download'></i>
					<span class="text">Download PDF</span>
				</a> --}}
        </div>
        <main class="table" id="customers_table">
            <section class="table__header">
                <div class="input-group">
                    <input type="search" placeholder="Rechercher...">
                    <img src="{{ asset('img/search.png') }}" alt="">
                </div>
            </section>
            @if ($etudiants->count() > 0)
                <section class="table__body">
                    <table>
                        <thead>
                            <tr>
                                <th> INE <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Nom <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Prenom <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Filière <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Année Scolaire <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Nombre Aparreil <span class="icon-arrow">&UpArrow;</span></th>
                                <th> Action <span class="icon-arrow">&UpArrow;</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($etudiants as $etudiant)
                                <tr>
                                    <td>{{ $etudiant->INE }}</td>
                                    <td>{{ $etudiant->personne->nom }}</td>
                                    <td>{{ $etudiant->personne->prenom }}</td>
                                    <td>{{ $etudiant->filiere }}</td>
                                    <td>{{ $etudiant->annee_scolaire }} / {{ $etudiant->annee_scolaire + 1}}</td>
                                    <td>{{ $etudiant->appareils->count() }}</td>
                                    <td class="action">
                                        <a href="#" data-bs-toggle="modal"
                                            data-bs-target="#ModalModifier{{ $etudiant->INE }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        @include('etudiants.modifier')
                                        <form action="/liste_etudiants/supprimer/{{ $etudiant->INE }}"
                                            method="post" class="action delete-form">
                                            @csrf
                                            <button type="submit" class="sub"
                                                style="background: none; border: none; color: red; cursor: pointer;">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </section>
            @else
                <div>
                    <p>Aucun étudiant trouvé</p>
                </div>
            @endif
        </main>

        <!-- Script JavaScript -->
        <script src="js/script.js"></script>
        @include('partials.script')
        @if (session('status'))
            <script>
                Swal.fire({
                    title: "Félicitation!",
                    text: "Votre action a été réalisé avec succès",
                    icon: "success",
                    allowOutsideClick: false, // **Désactivation de la fermeture en cliquant en dehors**
                    showConfirmButton: true, // **Affichage du bouton OK**
                });
            </script>
        @endif
        <script>
            $('.delete-form').on('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Êtes vous sûre?",
                    text: "Vous ne pourrez pas revenir en arrière !",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    confirmButtonText: "Oui, supprimer!",
                    cancelButtonColor: "#3085d6",
                    cancelButtonText: "Annuler",
                    allowOutsideClick: false, // **Désactivation de la fermeture en cliquant en dehors**
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        </script>
        <!-- Bootstrap JS Bundle with Popper -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
