<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Rapport des appareils</title>
    <style>
        @page {
            size: A4 landscape;
            /* Changer l'orientation en paysage */
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 20px;
            /* Augmenter la taille de la police */
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
        }

        td img {
            width: 36px;
            height: 36px;
            margin-right: .5rem;
            border-radius: 50%;
            vertical-align: middle;
        }

        table,
        th,
        td {
            border-collapse: collapse;
            padding: 1rem;
            text-align: left;
        }

        thead th {
            position: sticky;
            top: 0;
            left: 0;
            background-color: var(--blue);
            cursor: pointer;
            text-transform: capitalize;
            color: #585858;
        }

        tbody tr:nth-child(even) {
            background-color: #3c91e64c;
        }

        tbody tr:nth-child(odd) {
            background-color: #3c91e60b;
        }

        tbody tr {
            --delay: .1s;
            transition: .5s ease-in-out var(--delay), background-color 0s;
        }

        tbody tr.hide {
            opacity: 0;
            transform: translateX(100%);
        }

        tbody tr.hide td,
        tbody tr.hide td p {
            padding: 0;
            font: 0 / 0 sans-serif;
            transition: .2s ease-in-out .5s;
        }

        tbody tr.hide td img {
            width: 0;
            height: 0;
            transition: .2s ease-in-out .5s;
        }


        h2 {
            color: #fe5657;
            font-weight: bold;
            font-size: 40px;
        }

        .status {
            padding: .4rem 0;
            border-radius: 2rem;
            text-align: center;
        }

        .status.delivered {
            background-color: #86e49d;
            color: #006b21;
        }

        .status.shipped {
            background-color: #6fcaea;
        }
    </style>
</head>

<body>
    <div>
        <div>
            <h2>Rapport appareils</h2>
            <table>
                <thead>
                    <tr>
                        <th> Adresse MAC</th>
                        <th> Type d'appareils</th>
                        <th> Marque</th>
                        <th> Propriétaire</th>
                        <th> Statut</th>
                        <th> Connexion</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($appareils as $appareil)
                        <tr>
                            <td>{{ $appareil->adresse_mac }}</td>
                            <td>{{ $appareil->type_appareil }}</td>
                            <td>{{ $appareil->marque }}</td>
                            @if ($appareil->etudiant)
                                <td> {{ $appareil->etudiant->personne->nom }} {{ $appareil->etudiant->personne->prenom }}
                                </td>
                            @endif
                            @if ($appareil->personnel)
                                <td> {{ $appareil->personnel->personne->nom }}{{ $appareil->personnel->personne->prenom }}
                                </td>
                            @endif
                            <td>
                                @if ($appareil->etudiant)
                                    <p class="status delivered">Etudiant</p>
                                @endif
                                @if ($appareil->personnel)
                                    <p class="status shipped">Personnel</p>
                                @endif
                            </td>
                            <td>{{ $appareil->connexion->nom }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
