	<!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand">
            <span class="gestion">GESTION</span><span class="connexion">CONNEXION</span>
        </a>
        <div class="text-center">
            <img src="{{ asset('img/user1.jpg') }}" alt="Image de l'utilisateur" class="img-thumbnail rounded-circle" style="width: 80px; height: 80px;">
            <span id="username" class="d-block mt-2" style="font-size: 20px">{{ auth()->user()->nom }} {{ auth()->user()->prenom }}</span>
        </div>
        <ul class="side-menu top">
            <li>
                <a href="/dashboard" class="menu-link">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Tableau de bord</span>
                </a>
            </li>
            <li class="has-submenu">
                <a href="#" class="menu-link">
                    <i class='bx bxs-graduation'></i>
                    <span class="text">Étudiants</span>
                    <i class="bx bx-chevron-right submenu-toggle"></i>
                </a>
                <ul class="submenu">
                    <li><a href="/ajout_etudiant">Ajouter un étudiant</a></li>
                    <li><a href="/liste_etudiants">Liste des étudiants</a></li>
                </ul>
            </li>
            <li class="has-submenu">
                <a href="#" class="menu-link">
                    <i class='bx bxs-user'></i>
                    <span class="text">Personnel</span>
                    <i class="bx bx-chevron-right submenu-toggle"></i>
                </a>
                <ul class="submenu">
                    <li><a href="/ajout_personnel">Ajouter un personnel</a></li>
                    <li><a href="/liste_personnels">Liste des personnels</a></li>
                </ul>
            </li>
            <li class="has-submenu">
                <a href="#" class="menu-link">
                    <i class='bx bx-wifi'></i>
                    <span class="text">Connexions</span>
                    <i class="bx bx-chevron-right submenu-toggle"></i>
                </a>
                <ul class="submenu">
                    <li><a href="/ajout_connexion">Ajouter une connexion</a></li>
                    <li><a href="/liste_connexions">Liste des connexions</a></li>
                </ul>
            </li>
            <li class="has-submenu">
                <a href="#" class="menu-link">
                    <i class='bx bxs-devices'></i>
                    <span class="text">Appareils</span>
                    <i class="bx bx-chevron-right submenu-toggle"></i>
                </a>
                <ul class="submenu">
                    <li><a href="/ajout_appareil">Ajouter un appareil</a></li>
                    <li><a href="/liste_appareils">Liste des appareils</a></li>
                </ul>
            </li>
            <li class="has-submenu">
                <a href="#" class="menu-link">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="text">Utilisateurs</span>
                    <i class="bx bx-chevron-right submenu-toggle"></i>
                </a>
                <ul class="submenu">
                    <li><a href="/inscription">Ajouter un utilisateur</a></li>
                    <li><a href="/liste_utilisateurs">Liste des utilisateurs</a></li>
                </ul>
            </li>
            <li>
                <a href="/export" class="menu-link">
                    <i class='bx bx-export'></i>
                    <span class="text">Exporter</span>
                </a>
            </li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="/deconnexion" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
                    <span class="text">Déconnexion</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- SIDEBAR -->

	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu'></i>
		</nav>
		<!-- NAVBAR -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const hasSubmenuLinks = document.querySelectorAll('.has-submenu > .menu-link');

                hasSubmenuLinks.forEach(link => {
                    const submenu = link.nextElementSibling;
                    const submenuToggle = link.querySelector('.submenu-toggle');

                    link.addEventListener('click', (e) => {
                        e.preventDefault();
                        submenu.classList.toggle('show');
                        submenuToggle.classList.toggle('rotate');
                    });
                });
            });
        </script>
