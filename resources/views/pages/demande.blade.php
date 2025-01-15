<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!--=============== CSS ===============-->
    <link rel="icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.3-dist/css/bootstrap.css') }}">

    <title>Enregistrement des appareils</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container-fluid">
            <!-- Logo à gauche -->
            <a class="navbar-brand col-lg-5" href="/"><span class="gestion">GESTION</span><span
                    class="connexion">CONNEXION</span></a>

            <!-- Éléments de navigation à droite -->
            <div class="collapse navbar-collapse col-lg-6" id="navbarNav">
                <ul class="navbar-nav w-100 d-flex justify-content-between">
                    <li class="nav-item">
                        <a class="nav-link" href="/#acceuil">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/#service">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/#a-propos">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/#contact">Contact</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="login__content">
            <img src="{{ asset('assets/img/bg.jpg') }}" alt="login image" class="login__img">

            <form action="/demande_ajout_appareilTraitement" class="login__form" method="POST">
                @csrf
                <div>
                    <h1 class="login__title">
                        <span>Bienvenue</span> chers étudiants
                    </h1>
                    <p class="login__description">
                        Veuillez remplir le formulaire ci-dessous.
                    </p>
                </div>


                <div>
                    <div class="login__inputs">
                        <div>
                            <label for="ine" class="login__label">INE</label>
                            <input type="text" name="ine" class="login__input @error('ine') is-invalid @enderror"
                                placeholder="Entrez votre INE" required>
                            @error('ine')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="password" class="login__label">Mot de passe : </label>
                            <input type="password" name="password" class="login__input @error('password') is-invalid @enderror"
                                placeholder="Mot de passe" required>
                        </div>
                        <div>
                            <label for="adresse_mac" class="login__label">Adresse MAC</label>
                            <input type="text" class="login__input @error('adresse_mac') is-invalid @enderror"
                                id="adresse_mac" name="adresse_mac" value="{{ old('adresse_mac') }}"
                                placeholder="xx:xx:xx:xx:xx:xx" required>
                            @error('adresse_mac')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="login__label">Marque</label>
                            <input type="text" class="login__input @error('marque') is-invalid @enderror"
                                id="marque" name="marque" value="{{ old('marque') }}"
                                placeholder="Hp, Dell, IPhone..." required>
                            @error('marque')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label class="login__label">Type d'appareil</label>
                            <select class="login__input @error('type_appareil') is-invalid @enderror"
                                aria-label="Large select example" name="type_appareil" id="type_appareil" required>
                                <option value="">Choisisser le type d'appareil</option>
                                <option value="Ordinateur"
                                    {{ old('type_appareil') == 'Ordinateur' ? 'selected' : '' }}>Ordinateur
                                </option>
                                <option value="Smartphone"
                                    {{ old('type_appareil') == 'Smartphone' ? 'selected' : '' }}>Smartphone
                                </option>
                                <option value="Tablette" {{ old('type_appareil') == 'Tablette' ? 'selected' : '' }}>
                                    Tablette
                                </option>
                            </select>
                            @error('type_appareil')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>

                <div>
                    <div class="login__buttons">
                        <button type="submit" class="login__button">Enregistrer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"
        style="background: white !important; position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
        <img style="width: auto; height: 120px;" src="{{ asset('img/devices-removebg-preview.png') }}" alt="">
        <p style="color: black">Mes appareils</p>
    </button>


    <!-- Premier Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="gestion"><i class='bx bxs-devices'></i></span>
                    <span class="connexion"> Voir mes appareils</span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/mes_appareils" method="post">
                        @csrf
                        <div class="login__inputs">
                            <div>
                                <label for="inere" class="login__label">INE</label>
                                <input type="text" id="ineInput" name="inere"
                                    class="login__input @error('inere') is-invalid @enderror"
                                    placeholder="Entrez votre INE" required>
                                @error('inere')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="ine" class="login__label">Mot de passe : </label>
                            <input type="password" name="ine" class="login__input @error('ine') is-invalid @enderror"
                                placeholder="Mot de passe" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary">Valider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Deuxième Modal -->
    <div class="modal fade" id="secondModal" tabindex="-1" aria-labelledby="secondModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="gestion"><i class='bx bxs-devices'></i>   </span>
                    <span class="connexion">
                        @if(session('etudiant'))
                            {{ session('etudiant')->INE }} :
                            {{ session('etudiant')->personne->nom }}
                            {{ session('etudiant')->personne->prenom }}
                        @else
                            Non trouvé
                        @endif
                    </span>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>


                <div class="modal-body">
                    <div id="deviceInfo">
                        @if (session('appareils'))
                            @foreach (session('appareils') as $appareil)
                                <div class="device-item d-flex align-items-center mb-3">
                                    <div style="font-size:18px;">
                                        <span style="font-weight:bold;">Adresse MAC:</span> {{ $appareil->adresse_mac }}<br>
                                        <span style="font-weight:bold;">Type appareil:</span> {{ $appareil->type_appareil }}<br>
                                        <span style="font-weight:bold;">Marque:</span> {{ $appareil->marque }}
                                    </div>
                                    <div class="ms-auto">
                                        @if ($appareil->type_appareil == 'Ordinateur')
                                            <img src="{{ asset('img/ordinateur.png') }}" alt="Ordinateur"
                                                class="device-img">
                                        @elseif($appareil->type_appareil == 'Tablette')
                                            <img src="{{ asset('img/tablette.png') }}" alt="Tablette"
                                                class="device-img">
                                        @elseif($appareil->type_appareil == 'Smartphone')
                                            <img src="{{ asset('img/smartphone.png') }}" alt="Smartphone"
                                                class="device-img">
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>Aucun appareil enregistré.</p>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Vérifier si des erreurs sont présentes ou des appareils
        document.addEventListener('DOMContentLoaded', function() {
            if (@json($errors->any())) {
                var exampleModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                exampleModal.show();
            } else if (@json(session('appareils'))) {
                var secondModal = new bootstrap.Modal(document.getElementById('secondModal'));
                secondModal.show();
            }
        });
    </script>

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
    <!--=============== MAIN JS ===============-->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
