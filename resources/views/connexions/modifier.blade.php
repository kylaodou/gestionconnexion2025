<div class="modal fade" id="ModalModifier{{ $connexion->id }}" tabindex="-1"
    aria-labelledby="ModalModifierLabel{{ $connexion->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="ModalModifierLabel" ><span class="gestion"> <i class='bx bx-wifi'></i> Modifier la connexion : </span><span class="connexion">{{ $connexion->nom }}</span></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/liste_connexions/modifier/{{ $connexion->id }}" method="post"
                    enctype="multipart/form-data" id="myForm{{ $connexion->id }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $connexion->id }}">
                    <label>Nom de la connexion</label>
                <input type="text" class="@error('nom') is-invalid @enderror" id="nom" name="nom"
                    value="{{ $connexion->nom }}" placeholder="Nom de la connexion">
                @error('nom')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label>Bande passante</label>
                <input type="text" class="@error('bande_passante') is-invalid @enderror" id="bande_passante" name="bande_passante"
                    value="{{ $connexion->bande_passante }}" placeholder="Bande passante">
                @error('bande_passante')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label>Nombre d'utilisateur maximun</label>
                <input type="number" class="@error('nbr_utilisateur') is-invalid @enderror" id="nbr_utilisateur" name="nbr_utilisateur"
                    value="{{ $connexion->nbr_utilisateur }}" placeholder="Nombre d'utilisateurs">
                @error('nbr_utilisateur')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <label>Operateur</label>
                <input type="text" class="@error('operateur') is-invalid @enderror" id="operateur" name="operateur"
                    value="{{ $connexion->operateur }}" placeholder="Opérateur">
                @error('operateur')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                    <div style="height: 10px;"></div>
                    <button type="submit" class="non">Modifier</button>
                    <div style="height: 10px;"></div>
                </form>
            </div>
        </div>
    </div>
</div>
