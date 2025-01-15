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
                        <a href="#">Exporter</a>
                    </li>
                    <li><i class='bx bx-chevron-right'></i></li>
                    <li>
                        <a class="active" href="/export">Exporter une table</a>
                    </li>
                </ul>
            </div>


        </div>
        <ul class="box-info">
                <a href="/pdf-etudiants">
                    <i class='bx bxs-file-pdf' ></i>
                <span class="text">
                    <h3>Exporter pdf</h3>
                    <p>Etudiants</p>
                </span>
                </a>
            <a href="/pdf-personnels">
                <i class='bx bxs-file-pdf' ></i>
                <span class="text">
                    <h3>Exporter pdf</h3>
                    <p>Personnels</p>
                </span>
            </a>
            <a href="/pdf-connexions">
                <i class='bx bxs-file-pdf' ></i>
                <span class="text">
                    <h3>Exporter pdf</h3>
                    <p>Connexions</p>
                </span>
            </a>
            <a href="/pdf-appareils">
                <i class='bx bxs-file-pdf' ></i>
                <span class="text">
                    <h3>Exporter pdf</h3>
                    <p>Appareils</p>
                </span>
            </a>
        </ul>
        <ul class="box-info">
            <a href="/export-etudiants">
                <i class="fa-solid fa-file-excel"></i>
                <span class="text">
                    <h3>Exporter excel</h3>
                    <p>Etudiants</p>
                </span>
            </a>
            <a href="/export-personnels">
                <i class="fa-solid fa-file-excel"></i>
                <span class="text">
                    <h3>Exporter excel</h3>
                    <p>Personnels</p>
                </span>
            </a>
            <a href="/export-connexions">
                <i class="fa-solid fa-file-excel"></i>
                <span class="text">
                    <h3>Exporter excel</h3>
                    <p>Connexions</p>
                </span>
            </a>
            <a href="/export-appareils">
                <i class="fa-solid fa-file-excel"></i>
                <span class="text">
                    <h3>Exporter excel</h3>
                    <p>Appareils</p>
                </span>
            </a>
        </ul>
            <main>
        @include('partials.script')
        <!-- Script JavaScript -->
        <script src="js/script.js"></script>
        <!-- Bootstrap JS Bundle with Popper -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>

</html>
