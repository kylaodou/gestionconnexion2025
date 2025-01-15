@include('partials.header')

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
                        <a class="nav-link" href="#acceuil">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#service">Service</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#a-propos">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li class="nav-item nav-itema">
                        <button type="button"><a href="/connexion_inscription">Connexion</a></button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="barriere" id="acceuil">
        <div class="pageaceuilContainer" style="width: 1000px; margin: 0 auto;">
            <div class="barriereHeader">
                <h1><span class="gestionh">G</span><span class="connexionh">C</span></h1>
                <p><span class="gestionp">Gestion de la </span><span class="connexionp">Connexion internet</span></p>
            </div>
            <p class="barriereSlogan">
                Notre service de veille vous tient informé en temps réel des évolutions dans notre système de
                gestion de connexions Internet pour les universités. Assurez un suivit performant de vos étudiants et personnels. Restez à l'avant-garde des performances réseau,
                anticipez et gérez les perturbations pour une expérience Internet fluide. Ne manquez aucune
                information cruciale et optimisez vos infrastructures réseau avec notre expertise pour un avenir
                prospère de votre université.
            </p>
            <a type="button" class="btn btn-primary" href="/demande"
                style="background: white !important; position: absolute; bottom: 20px; left: 255px; z-index: 1000;">
                <img style="width: auto; height: 120px;" src="{{ asset('img/student_4196591.png') }}" alt="">
                <p style="color: black">Vous êtes un étudiant?</p>
                <p style="color: black">Enregistrez vos appareils</p>
            </a>
            <a type="button" class="btn btn-primary" href="/demande_personnel"
                style="background: white !important; position: absolute; bottom: 20px; left: 525px; z-index: 1000;">
                <img style="width: auto; height: 120px;" src="{{ asset('img/Capture_d_écran_2024-07-01_092507-removebg-preview.png') }}" alt="">
                <p style="color: black">Vous êtes un personnel?</p>
                <p style="color: black">Enregistrez vos appareils</p>
            </a>

        </div>

    </div>
    <div class="pageaceuilFuture" id="service">
        <div class="pageaceuilfuture">
            <span class="futureicon"><i class="fa-solid fa-gear"></i></span>
            <h3 class="futureTitle">Suivit des utilisateurs</h3>
            <p class="futureDescription">Dans un monde commercial en constante évolution, la gestion de vos utilisateurs
                nécessite
                une adaptation.</p>
        </div>
        <div class="pageaceuilfuture">
            <span class="futureicon"><i class="fa-solid fa-star"></i></span>
            <h3 class="futureTitle">Conception de plan</h3>
            <p class="futureDescription">La conception d'un plan efficace dans la gestion de connexion est essentielle
                pour
                optimiser les opérations. </p>
        </div>
        <div class="pageaceuilfuture">
            <span class="futureicon"><i class="fa-solid fa-earth-africa"></i></span>
            <h3 class="futureTitle">Atteidre votre audience</h3>
            <p class="futureDescription">Atteindre votre audience dans la gestion de la connexion nécessite une approche
                stratégique.</p>
        </div>
    </div>
    <div class="pageaceuilNotification" id="a-propos">
        <div class="pageacceuilNotificationContainer">
            <div class="emailForm">
                <h3>Restez informé des mises à jour essentielles ! !</h3>
                <p>
                    Notre service de veille vous tient informé en temps réel des évolutions dans notre système de
                    gestion de connexions Internet pour les universités. Assurez un suivit performant de vos étudiants et personnels. Restez à l'avant-garde des performances réseau,
                    anticipez et gérez les perturbations pour une expérience Internet fluide. Ne manquez aucune
                    information cruciale et optimisez vos infrastructures réseau avec notre expertise pour un avenir
                    prospère de votre université.
                </p>
            </div>
            <div class="col-md-6">
                <img src="{{ asset('img/learning-education-ideas-insight-intelligence-study-concept.jpg') }}"
                    class="img-fluid float-end" alt="Description de l'image">
            </div>
        </div>
    </div>
    <div class="socials" id="contact">
        <h3>Contacter nous</h3>
        <p>Nous sommes à votre écoute et prêts à répondre à toutes vos questions.</p>
        <div class="socialIcons">
            <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
            <a href="#"><i class="fa-brands fa-telegram"></i></a>
            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#"><i class="fa-regular fa-envelope"></i></i></a>
            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
        </div>
    </div>
    <div class="footer">
        <a href="#">Contact</a>
        <a href="#">Téléchargement</a>
        <a href="#">Support</a>
        <a href="#">Confidentialité</a>
        <a href="#">Politique</a>
    </div>
</body>

</html>
