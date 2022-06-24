const titleImgEffect = {


    init: function () {


        let titleSpirit = document.querySelector(".pages-main-title");

        if (titleSpirit != null) {
            titleSpirit.addEventListener('mouseenter', titleImgEffect.turn);
            titleSpirit.addEventListener('mouseleave', titleImgEffect.stop)
        }


        /* window.addEventListener('scroll', function () {
            console.log(window.pageYOffset );
            if (window.pageYOffset > 1200) {
                let body = document.querySelector('body').style.background ='red'; 
            }else{
                let body = document.querySelector('body').style.background ='none'; 

            } 
        }); */


    },

    turn: function () {
        let imgSpirit = document.querySelector(".pages-main-title img");
        imgSpirit.style.animation = 'rotation 2s infinite linear';
    },

    stop: function () {
        let imgSpirit = document.querySelector(".pages-main-title img");
        imgSpirit.style.animation = 'none';
    }
}