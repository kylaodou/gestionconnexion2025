<div class="modal fade" id="ModalModifier{{ $etudiant->INE }}" tabindex="-1"
    aria-labelledby="ModalModifierLabel{{ $etudiant->INE }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="ModalModifierLabel" ><span class="gestion"><i class='bx bxs-graduation'></i> Modifier l'étudiant : </span><span class="connexion">{{ $etudiant->INE }}</span></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/liste_etudiants/modifier/{{ $etudiant->INE }}" method="post"
                    enctype="multipart/form-data" id="myForm{{ $etudiant->INE }}">
                    @csrf
                    <label>Nom</label>
                    <input type="text" class="@error('nom') is-invalid @enderror" id="nom" name="nom"
                        value="{{ $etudiant->personne->nom }}" placeholder="Nom">
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <label>Prenom</label>
                    <input type="text" class="@error('prenom') is-invalid @enderror" id="prenom" name="prenom"
                        value="{{ $etudiant->personne->prenom }}" placeholder="Prénom">
                    @error('prenom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <label>Filière</label>
                    <input type="text" class="@error('filiere') is-invalid @enderror" id="filiere" name="filiere"
                        value="{{ $etudiant->filiere }}" placeholder="Filière">
                    @error('filiere')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <label>Année scolaire en cours</label>
                    <input type="number" class="@error('annee_scolaire') is-invalid @enderror" id="annee_scolaire"
                        name="annee_scolaire" placeholder="Année Scolaire en cours" value="{{ $etudiant->annee_scolaire }}">
                    @error('annee_scolaire')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div style="height: 1;"></div>
                    <button type="submit" class="non">Modifier</button>
                    <div style="height: 10px;"></div>
                </form>
            </div>
        </div>
    </div>
</div>
