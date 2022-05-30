const menuBurger = {


    init: function () {

        let burgerButton = document.querySelector('.burger-button');

        burgerButton.addEventListener('click', menuBurger.toggleMenu);
    },

    toggleMenu: function() {

        const menu = document.querySelector(".burger-nav_list");
        const menuItems = document.querySelectorAll(".menuItem");
        let hamburger = document.querySelector(".burger-button");
        let linesButton = document.querySelectorAll('.button-line');
        let pMenu = document.querySelector('.burger-menu_item p');

            if (menu.classList.contains("burger-nav_list--show")) {
                menu.classList.remove("burger-nav_list--show");
                linesButton.forEach(element => {
                    element.style.background = "black";
                });
                pMenu.style.color = "black";
            } else {
                menu.classList.add("burger-nav_list--show");
                linesButton.forEach(element => {
                    element.style.background = "#5eaabd";
                });
                pMenu.style.color = "#5eaabd";
            }   
    }
}