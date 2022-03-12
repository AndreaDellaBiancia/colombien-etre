const app = {

    init: function () {
        
        //On initialise la navbar
        navbar.init();
    },
    
    
};

// Permet d'exécuter notre code une fois le DOM chargé
// lorsque l'event DOMContentLoaded survient => la méthode app.init est appelée
// donc app.init n'est pas exécuter lorsque JS lit cette ligne de code
document.addEventListener('DOMContentLoaded', app.init);