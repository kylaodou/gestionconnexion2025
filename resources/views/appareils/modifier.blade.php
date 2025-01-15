<div class="modal fade" id="ModalModifier{{ $appareil->adresse_mac }}" tabindex="-1"
    aria-labelledby="ModalModifierLabel{{ $appareil->adresse_mac }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="ModalModifierLabel">
                    <span class="gestion"><i class='bx bxs-devices'></i> Modifier l'appareil :</span>
                    <span class="connexion">{{ $appareil->adresse_mac }}</span>
                </h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/liste_appareils/modifier/{{ $appareil->adresse_mac }}" method="post"
                    enctype="multipart/form-data" id="myForm{{ $appareil->adresse_mac }}">
                    @csrf
                    @method('PUT')
                    <label></label>
                    <input type="text" class="@error('adresse_mac') is-invalid @enderror" id="adresse_mac"
                        name="adresse_mac" value="{{ $appareil->adresse_mac }}" placeholder="Adresse MAC">
                    @error('adresse_mac')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <label></label>
                    <input type="text" class="@error('marque') is-invalid @enderror" id="marque" name="marque"
                        value="{{ $appareil->marque }}" placeholder="Marque">
                    @error('marque')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <select class="form-select form-select-lg mb-3" name="type_appareil" id="type_appareil">
                        <option value="">Choisissez le type d'appareil</option>
                        <option value="Ordinateur" {{ $appareil->type_appareil == 'Ordinateur' ? 'selected' : '' }}>Ordinateur</option>
                        <option value="Smartphone" {{ $appareil->type_appareil == 'Smartphone' ? 'selected' : '' }}>Smartphone</option>
                        <option value="Tablette" {{ $appareil->type_appareil == 'Tablette' ? 'selected' : '' }}>Tablette</option>
                    </select>
                    @error('type_appareil')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <div class="col-sm-10 d-flex align-items-center">
                        <div class="form-check form-check-inline" style="font-size: 20px; margin-left:20px">
                            <input class="form-check-input" type="radio" name="user_type" id="etudiant_radio{{ $appareil->adresse_mac }}"
                                value="etudiant" {{ $appareil->id_etudiant ? 'checked' : '' }} onclick="toggleUserType('{{ $appareil->adresse_mac }}')">
                            <label class="form-check-label" for="etudiant_radio{{ $appareil->adresse_mac }}">Étudiant</label>
                        </div>
                        <div class="form-check form-check-inline" style="font-size: 20px">
                            <input class="form-check-input" type="radio" name="user_type" id="personnel_radio{{ $appareil->adresse_mac }}"
                                value="personnel" {{ $appareil->id_personnel ? 'checked' : '' }} onclick="toggleUserType('{{ $appareil->adresse_mac }}')">
                            <label class="form-check-label" for="personnel_radio{{ $appareil->adresse_mac }}">Personnel</label>
                        </div>
                    </div>

                    <div id="etudiant_section{{ $appareil->adresse_mac }}" style="{{ $appareil->id_etudiant ? 'display: block;' : 'display: none;' }} width: 100%">
                        <select class="form-select form-select-lg mb-3" name="etudiant" id="etudiant{{ $appareil->adresse_mac }}">
                            <option value="">Choisissez l'étudiant</option>
                            @foreach ($etudiants as $etudiant)
                                <option value="{{ $etudiant->INE }}"
                                    {{ $appareil->id_etudiant == $etudiant->INE ? 'selected' : '' }}>
                                    {{ $etudiant->INE }} - {{ $etudiant->personne->nom }} {{ $etudiant->personne->prenom }}
                                </option>
                            @endforeach
                        </select>
                        @error('etudiant')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div id="personnel_section{{ $appareil->adresse_mac }}" style="{{ $appareil->id_personnel ? 'display: block;' : 'display: none;' }} width: 100%">
                        <select class="form-select form-select-lg mb-3" name="personnel" id="personnel{{ $appareil->adresse_mac }}">
                            <option value="">Choisissez le personnel</option>
                            @foreach ($personnels as $personnel)
                                <option value="{{ $personnel->id_personnel }}" {{ $appareil->id_personnel == $personnel->id_personnel ? 'selected' : '' }}>
                                    {{ $personnel->personne->nom }} {{ $personnel->personne->prenom }}
                                </option>
                            @endforeach
                        </select>
                        @error('personnel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <select class="form-select form-select-lg mb-3" name="connexion" id="connexion">
                        <option value="">Choisissez la connexion attribuée</option>
                        @foreach ($connexions as $connexion)
                            <option value="{{ $connexion->id }}" {{ $appareil->id_connexion == $connexion->id ? 'selected' : '' }}>
                                {{ $connexion->nom }}
                            </option>
                        @endforeach
                    </select>
                    @error('connexion')
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
<script>
    function toggleUserType(adresseMac) {
        var etudiantSection = document.getElementById('etudiant_section' + adresseMac);
        var personnelSection = document.getElementById('personnel_section' + adresseMac);
        var userTypeEtudiant = document.getElementById('etudiant_radio' + adresseMac);
        var userTypePersonnel = document.getElementById('personnel_radio' + adresseMac);

        if (userTypeEtudiant.checked) {
            etudiantSection.style.display = 'block';
            personnelSection.style.display = 'none';
        } else if (userTypePersonnel.checked) {
            etudiantSection.style.display = 'none';
            personnelSection.style.display = 'block';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        @foreach ($appareils as $appareil)
            toggleUserType('{{ $appareil->adresse_mac }}');
        @endforeach
    });
</script>
