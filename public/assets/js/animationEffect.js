const animationEffect = {


    init: function () {

        //Animations for title's icon
        let title = document.querySelector(".pages-main-title");

        if (title != null) {
            title.addEventListener('mouseenter', animationEffect.turn);
            title.addEventListener('mouseleave', animationEffect.stop)
        }


        //Animations for corps & esprit page
        //For screens with less of 860px width the animation doesen't work
        if (window.matchMedia("(min-width: 860px)").matches) {

            let cards = document.querySelectorAll(".corps-esprit-cards article");

            cards.forEach(element => {
                element.addEventListener('mouseenter', animationEffect.turnTimeOut);
            });
        }

    },

    turn: function () {
        let img = document.querySelector(".pages-main-title img");
        img.style.animation = 'rotation 2s infinite linear';
    },

    stop: function () {
        let img = document.querySelector(".pages-main-title img");
        img.style.animation = 'none';
    },

    turnTimeOut: function (e) {

        let cardImg = e.target.querySelector(".corps-esprit-cards article img");

        e.target.style.animation = 'rotation infinite linear';
        e.target.style.animationDuration = '3s';
        cardImg.style.opacity = "1";
        setTimeout(() => {
            e.target.style.animation = 'none';
            cardImg.style.opacity = "0.5";
        }, "3000");


       
          
       
        


    }


}