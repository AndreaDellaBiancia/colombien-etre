const navbar = {


    init: function () {

        let navListItems = document.querySelectorAll('.nav_list_item');
        let navItems = [];
        navItems.push(navListItems[2]);
        navItems.push(navListItems[3]);

        
        let burgerButton = document.querySelector('.burger-button');
        
        if(burgerButton != null){
            burgerButton.addEventListener('click', navbar.toggleMenu);
        }
      

        for (let index = 0; index < navItems.length; index++) {
            let item = navItems[index];
            item.addEventListener('mouseenter', navbar.show);
            item.addEventListener('mouseleave', navbar.hide);
        }

    },

    toggleMenu: function () {

        const menu = document.querySelector(".burger-nav_list");
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
    },

    show: function (e) {

        let div = e.target.querySelector('div');
        div.classList.remove('nav_links_children');
        div.classList.add('nav_links_children--show');

    },

    hide: function (e) {

        let div = e.target.querySelector('div');
        div.classList.remove('nav_links_children--show');
        div.classList.add('nav_links_children');

    }
}