const filterButton = {


    init: function () {

       
        let button = document.querySelector('.filters h3');

        button.addEventListener('click', filterButton.toggleMenu);
    },

    toggleMenu: function () {

        const filters = document.querySelector(".filter_form");
        

        if (filters.classList.contains("filter_form--show")) {
            filters.classList.remove("filter_form--show");
            filters.classList.add("filter_form");
        } else{
            filters.classList.add("filter_form--show");
        }
    }
}