
const hamBurger = document.querySelector('.toggle-btn');

hamBurger.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("expand");
    document.querySelector(".navbar").classList.toggle("expand");;
});


/*Mostrar menú responsive */
const hamBurgerRes = document.querySelector('.toggle-btn-responsive');

hamBurgerRes.addEventListener("click", function () {
    const sidebar = document.querySelector("#sidebar");
    const sidebarfooter = document.querySelector(".sidebar-footer");
    const navbar = document.querySelector(".navbar");
    const toggleBtn = document.querySelector(".toggle-btn");

    if (sidebar.style.display === "none" || sidebar.style.display === "") {
        sidebar.style.display = "flex";
        if (sidebar.style.display = "flex") {
            setTimeout(() => {
                document.querySelector("#sidebar").classList.toggle("expand");
                toggleBtn.style.display = "none";
            })


        }

        sidebarfooter.style.display = "flex";
        hamBurgerRes.style.display = "none";
    } else {
        sidebar.style.display = "none";
    }


    /*Cerrar menú responsive */
    const closeMenu = document.querySelector('.sidebar-footer');

    closeMenu.addEventListener("click", function () {

        const sidebar = document.querySelector("#sidebar");
        sidebar.classList.remove("expand");
        setTimeout(() => {
            sidebar.style.display = "none";
            hamBurgerRes.style.display = "flex";
        }, 250);
    });

});


/*Indicador de menú sidebar */

const menuItems = document.querySelectorAll('.sidebar-item');

menuItems.forEach(item => {
    item.addEventListener('click', function () {

        menuItems.forEach(menuItem => menuItem.classList.remove('selected'));

        this.classList.add('selected');
    });
});



/*Indicador de los dropdownItems del menú perfil */

const dropdownItems = document.querySelectorAll('.dropdown-item');


dropdownItems.forEach(item => {
    item.addEventListener('click', function () {
        this.classList.add('selection')
    });
}); 