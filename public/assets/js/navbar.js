const navbar = {
    
    
    init : function(){

        let navListItems = document.querySelectorAll('.nav_list_item');
    
        for (let index = 0; index < navListItems.length; index++) {
            let item = navListItems[index];
            item.addEventListener('mouseenter', navbar.show );
            item.addEventListener('mouseleave', navbar.hide );
        }

    },

    show : function(e) {

        let div = e.target.querySelector('div');
        div.classList.remove('nav_links_children');
        div.classList.add('nav_links_children--show');
        
    },
    
        hide : function(e) {
            
        let div = e.target.querySelector('div');
        div.classList.remove('nav_links_children--show');
        div.classList.add('nav_links_children');
    
    }
}