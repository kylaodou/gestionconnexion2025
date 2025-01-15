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
                        <a class="active" href="/liste_personnels">Liste des personnels</a>
                    </li>
                </ul>
            </div>
            <span
                    class="connexion">Toltal : {{ $personnels->count() }} personnels</span>

            {{-- <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download'></i>
					<span class="text">Download PDF</span>
				</a> --}}
        </div>
        <main class="table" id="customers_table">
            <section class="table__header">
                <div class="input-group">
                    <input type="search" placeholder="Rechercher...">
                    <img src="{{asset('img/search.png')}}" alt="">
                </div>
            </section>
            @if ($personnels->count() > 0)
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th> ID <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Nom <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Prenom <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Direction <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Poste <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Nombre Aparreil <span class="icon-arrow">&UpArrow;</span></th>
                            <th> Action <span class="icon-arrow">&UpArrow;</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($personnels as $personnel)
                            <tr>
                                <td>{{ $personnel->id_personnel }}</td>
                                <td>{{ $personnel->personne->nom }}</td>
                                <td>{{ $personnel->personne->prenom }}</td>
                                <td>{{ $personnel->direction }}</td>
                                <td>{{ $personnel->poste }}</td>
                                <td>{{ $personnel->appareils->count() }}</td>
                                <td class="action">
                                    <a href="#" data-bs-toggle="modal"
                                        data-bs-target="#ModalModifier{{ $personnel->id_personnel }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    @include('personnels.modifier')
                                    <form action="/liste_personnels/supprimer/{{ $personnel->id_personnel }}"
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
                            <p>Aucun personnel trouvé</p>
                        </div>
                    @endif
        </main>
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
        <!-- Script JavaScript -->
        <script src="js/script.js"></script>
        <!-- Bootstrap JS Bundle with Popper -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
