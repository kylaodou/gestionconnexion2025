document.addEventListener('DOMContentLoaded', function () {
    const signUpButton = document.getElementById("signUp");
    const signInButton = document.getElementById("signIn");
    const container = document.getElementById("container");

    if (signUpButton) {
        signUpButton.addEventListener('click', () => {
            container.classList.add('right-panel-active');
        });
    }

    if (signInButton) {
        signInButton.addEventListener('click', () => {
            container.classList.remove('right-panel-active');
        });
    }

    const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

    allSideMenu.forEach(item => {
        const li = item.parentElement;

        item.addEventListener('click', function () {
            allSideMenu.forEach(i => {
                i.parentElement.classList.remove('active');
            })
            li.classList.add('active');
        })
    });

    const menuBar = document.querySelector('#content nav .bx.bx-menu');
    const sidebar = document.getElementById('sidebar');

    menuBar.addEventListener('click', function () {
        sidebar.classList.toggle('hide');
    });

    const searchButton = document.querySelector('#content nav form .form-input button');
    const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
    const searchForm = document.querySelector('#content nav form');

    searchButton.addEventListener('click', function (e) {
        if (window.innerWidth < 576) {
            e.preventDefault();
            searchForm.classList.toggle('show');
            if (searchForm.classList.contains('show')) {
                searchButtonIcon.classList.replace('bx-search', 'bx-x');
            } else {
                searchButtonIcon.classList.replace('bx-x', 'bx-search');
            }
        }
    });

    if (window.innerWidth < 768) {
        sidebar.classList.add('hide');
    } else if (window.innerWidth > 576) {
        searchButtonIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }

    window.addEventListener('resize', function () {
        if (this.innerWidth > 576) {
            searchButtonIcon.classList.replace('bx-x', 'bx-search');
            searchForm.classList.remove('show');
        }
    });

    const switchMode = document.getElementById('switch-mode');

    switchMode.addEventListener('change', function () {
        if (this.checked) {
            document.body.classList.add('dark');
        } else {
            document.body.classList.remove('dark');
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var menuToggles = document.querySelectorAll('.menu-toggle');

    menuToggles.forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            var subMenu = this.nextElementSibling;
            var chevron = this.querySelector('.chevron');
            if (subMenu.style.display === "block") {
                subMenu.style.display = "none";
                chevron.style.transform = "rotate(0deg)";
            } else {
                subMenu.style.display = "block";
                chevron.style.transform = "rotate(180deg)";
            }
        });
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const currentLocation = window.location.pathname;
    const menuLinks = document.querySelectorAll('.menu-link');

    menuLinks.forEach(link => {
        if (link.getAttribute('href') === currentLocation) {
            link.classList.add('active');
        }

        link.addEventListener('click', function () {
            menuLinks.forEach(link => link.classList.remove('active'));
            this.classList.add('active');
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const currentLocation = window.location.pathname;
    const menuLinks = document.querySelectorAll('.menu-link');

    menuLinks.forEach(link => {
        if (link.getAttribute('href') === currentLocation) {
            link.parentElement.classList.add('active');
        }

        link.addEventListener('click', function () {
            menuLinks.forEach(link => link.parentElement.classList.remove('active'));
            this.parentElement.classList.add('active');
        });
    });
});


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
document.addEventListener('DOMContentLoaded', function () {
    const menuEtudiants = document.getElementById('menu-etudiants');
    const submenuLinks = menuEtudiants.querySelectorAll('.submenu a');

    submenuLinks.forEach(link => {
        link.addEventListener('click', () => {
            // Supprimez la classe "active" de tous les éléments de menu
            const menuItems = document.querySelectorAll('.side-menu.top li');
            menuItems.forEach(item => item.classList.remove('active'));

            // Ajoutez la classe "active" à l'élément parent "Étudiants"
            menuEtudiants.classList.add('active');
        });
    });
});
/**
Responsive HTML Table With Pure CSS - Web Design/UI Design

Code written by:
👨🏻‍⚕️ @Coding Design (Jeet Saru)

> You can do whatever you want with the code. However if you love my content, you can **SUBSCRIBED** my YouTube Channel.

🌎link: www.youtube.com/codingdesign
*/

const search = document.querySelector('.input-group input'),
    table_rows = document.querySelectorAll('tbody tr'),
    table_headings = document.querySelectorAll('thead th');

// 1. Searching for specific data of HTML table
search.addEventListener('input', searchTable);

function searchTable() {
    table_rows.forEach((row, i) => {
        let table_data = row.textContent.toLowerCase(),
            search_data = search.value.toLowerCase();

        row.classList.toggle('hide', table_data.indexOf(search_data) < 0);
        row.style.setProperty('--delay', i / 25 + 's');
    })

    document.querySelectorAll('tbody tr:not(.hide)').forEach((visible_row, i) => {
        visible_row.style.backgroundColor = (i % 2 == 0) ? 'transparent' : '#0000000b';
    });
}

