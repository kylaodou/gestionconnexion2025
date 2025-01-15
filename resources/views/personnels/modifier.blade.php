<div class="modal fade" id="ModalModifier{{ $personnel->id_personnel }}" tabindex="-1"
    aria-labelledby="ModalModifierLabel{{ $personnel->id_personnel }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="ModalModifierLabel"><span class="gestion"> <i class='bx bxs-user'></i> Modifier
                        le personnel : </span><span class="connexion">{{ $personnel->id_personnel }}</span></h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/liste_personnels/modifier/{{ $personnel->id_personnel }}" method="post"
                    enctype="multipart/form-data" id="myForm{{ $personnel->id_personnel }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $personnel->id_personnel }}">
                    <label>Nom :</label>
                    <input type="text" id = "nom" name="nom" value="{{ $personnel->personne->nom }}" required
                        placeholder="Nom" />
                    @if ($errors->has('nom'))
                        <p class="error">{{ $errors->first('nom') }}</p>
                    @endif
                    <label>Prenom</label>
                    <input type="text" id = "prenom" name="prenom" value="{{  $personnel->personne->prenom }}" required
                        placeholder="Prenom" />
                    @if ($errors->has('prenom'))
                        <p class="error">{{ $errors->first('prenom') }}</p>
                    @endif
                    <label>Direction</label>
                    <input type="text" id = "direction" name="direction" value="{{  $personnel->direction }}" required
                        placeholder="Direction" />
                    @if ($errors->has('direction'))
                        <p class="error">{{ $errors->first('direction') }}</p>
                    @endif
                    <label>Poste</label>
                    <input type="text" id = "poste" name="poste" value="{{  $personnel->poste }}" required
                        placeholder="Poste" />
                    @if ($errors->has('poste'))
                        <p class="error">{{ $errors->first('poste') }}</p>
                    @endif
                    <div style="height: 10px;"></div>
                    <button type="submit" class="non">Modifier</button>
                    <div style="height: 10px;"></div>
                </form>
            </div>
        </div>
    </div>
</div>
