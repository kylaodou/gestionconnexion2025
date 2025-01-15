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
                        <a class="active" href="#">Accueil</a>
                    </li>
                </ul>
            </div>


            {{-- <a href="#" class="btn-download">
					<i class='bx bxs-cloud-download'></i>
					<span class="text">Download PDF</span>
				</a> --}}
        </div>
        <ul class="box-info">
            <a>
                <i class='bx bxs-graduation' ></i>
                <span class="text">
                    <h3>{{$etud->count()}}</h3>
                    <p>Etudiants</p>
                </span>
            </a>
            <a>
                <i class='bx bxs-group' ></i>
                <span class="text">
                    <h3>{{$per->count()}}</h3>
                    <p>Personnels</p>
                </span>
            </a>
            <a>
                <i class='bx bxs-devices' ></i>
                <span class="text">
                    <h3>{{$appareils->count()}}</h3>
                    <p>Appareils</p>
                </span>
            </a>
            <a>
                <i class='bx bx-wifi' ></i>
                <span class="text">
                    <h3>{{$connexions->count()}}</h3>
                    <p>Connexions</p>
                </span>
            </a>
        </ul>
        <div style="display: flex;">
            <figure class="highcharts-figure" style="width: 50%;">
                <div id="container"></div>
                <p class="highcharts-description">
                    Le graphique circulaire ci-dessous montre la répartition des appareils enregistrés dans notre système, classés par type : ordinateurs, smartphones et tablettes. Chaque tranche représente une catégorie spécifique. Cliquez sur une tranche pour voir des informations détaillées sur cette catégorie, comme le nombre total d'appareils et les marques les plus courantes.
                </p>
            </figure>
            <div class="table-data" style="width: 50%;">
				<div class="order">
					<div class="head">
						<h3>Ajouter récemment</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Personne</th>
								<th>Date d'ajout</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
                            @foreach ($etudiant as $etud)
                                <tr>
                                    <td>
                                        <img src="img/10473220.jpg">
                                        <p>{{$etud->personne->nom}} {{$etud->personne->prenom}}</p>
                                    </td>
                                    <td>{{ $etud->created_at->format('d M Y à H:i:s') }}</td>
                                    <td><span class="status completed">Etudiant</span></td>
                                </tr>
                            @endforeach
                            @foreach ($personnel as $person)
                                <tr>
                                    <td>
                                        <img src="img/20546697_6306474.jpg">
                                        <p>{{$person->personne->nom}} {{$person->personne->prenom}}</p>
                                    </td>
                                    <td>{{ $person->created_at->format('d M Y à H:i:s') }}</td>
                                    <td><span class="status pending">Personnel</span></td>
                                </tr>
                            @endforeach
						</tbody>
					</table>
				</div>
            </div>
        </div>
        <script src="js/script.js"></script>
        @include('partials.script')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Highcharts.chart('container', {
                    chart: {
                        type: 'pie'
                    },
                    title: {
                        text: 'Nombre d\'appareils attribués aux étudiants et au personnel',
                        align: 'left'
                    },
                    subtitle: {
                        text: 'Cliquez sur les tranches pour voir les détails.',
                        align: 'left'
                    },

                    accessibility: {
                        announceNewData: {
                            enabled: true
                        },
                        point: {
                            valueSuffix: ' appareils'
                        }
                    },

                    plotOptions: {
                        series: {
                            borderRadius: 5,
                            dataLabels: [{
                                enabled: true,
                                distance: 15,
                                format: '{point.name}'
                            }, {
                                enabled: true,
                                distance: '-30%',
                                filter: {
                                    property: 'percentage',
                                    operator: '>',
                                    value: 5
                                },
                                format: '{point.y:.1f} appareils',
                                style: {
                                    fontSize: '0.9em',
                                    textOutline: 'none'
                                }
                            }]
                        }
                    },

                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: ' +
                            '<b>{point.y}</b> appareils<br/>'
                    },

                    series: [{
                        name: 'Utilisateurs',
                        colorByPoint: true,
                        data: [{
                            name: 'Étudiants',
                            y: {{ $etudiants->sum('y') }},
                            drilldown: 'etudiants'
                        }, {
                            name: 'Personnel',
                            y: {{ $personnels->sum('y') }},
                            drilldown: 'personnels'
                        }]
                    }],
                    drilldown: {
                        series: [{
                            name: 'Étudiants',
                            id: 'etudiants',
                            data: @json($etudiants)
                        }, {
                            name: 'Personnel',
                            id: 'personnels',
                            data: @json($personnels)
                        }]
                    }
                });
            });
        </script>
        <!-- Script JavaScript -->


        <!-- Bootstrap JS Bundle with Popper -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
