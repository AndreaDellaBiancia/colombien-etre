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

            if (cards) {
                cards.forEach(element => {
                    element.addEventListener('mouseenter', animationEffect.turnTimeOut);
                });
            }

        }


        //Pagination
        const paginationButtons = document.querySelector('.pagination ul');

        if (paginationButtons) {
            let firstButton = paginationButtons.firstElementChild;
            let lastButton = paginationButtons.lastElementChild;

            let linkFirstButton = firstButton.querySelector('a');
            let linkLastButton = lastButton.querySelector('a');

            if (linkFirstButton) {
                linkFirstButton.textContent = "< Précédent";
            } else if (linkLastButton) {
                linkLastButton.textContent = "Suivant >";
            }



            if (firstButton.className == 'page-item disabled') {
                firstButton.style.display = "none";
            } else if (lastButton.className == 'page-item disabled') {
                lastButton.style.display = "none";
            }
        }


        //Animations for homepage
        if (window.matchMedia("(min-width: 860px)").matches) {

            //Animations products homepage
            window.addEventListener('scroll', animationEffect.showProduct);

            //Animations cards homepage
            window.addEventListener('scroll', animationEffect.showCards);

        }

        //Animation page 404
        const soleil = document.querySelector('.sun');
        if (soleil) {
            window.onload = function () {
                soleil.style.animation = 'spin 15s infinite linear';
            }
        }

        
        //Resize picture post page (ckeditor) mobile version
        if (window.matchMedia("(max-width: 859px)").matches) {

            let imgs = document.querySelectorAll(".post-page_post img");

            for (let index = 1; index < imgs.length; index++) {
                const postImg = imgs[index];
                postImg.style.maxHeight = "500px";
                
            }

        }

        //Resize picture post page desktop version
        if (window.matchMedia("(min-width: 860px)").matches) {

            let imgs = document.querySelectorAll(".post-page_post img");
                console.log(imgs);
            for (let index = 1; index < imgs.length; index++) {
                const el = imgs[index];
                el.style.maxHeight = "850px";
                
            }
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

        const cardImg = e.target.querySelector(".corps-esprit-cards article img");

        e.target.style.animation = 'rotation infinite linear';
        e.target.style.animationDuration = '3s';
        cardImg.style.opacity = "1";
        setTimeout(() => {
            e.target.style.animation = 'none';
        }, "3000");
    },

    showProduct: function () {

        if (window.pageYOffset > 1100) {
            let homeShopItems = document.querySelector('.home-shop-items');
            if (homeShopItems) {
                homeShopItems.style = "opacity: 1; transition: 6s";
                setTimeout(() => {
                    document.querySelector('.home-allProducts').style = "opacity: 1;";
                }, "2500");
            }

        } else {
            let homeShopItems = document.querySelector('.home-shop-items');
            if (homeShopItems) {
                homeShopItems.style = "opacity: 0; transition: 2s";
                document.querySelector('.home-allProducts').style = "opacity: 0; transition: none";
            }

        }
    },

    showCards: function () {

        let cards = document.querySelectorAll('.home-card');

        const leftSide = [];
        const rightSide = [];

        leftSide.push(cards[1]);
        leftSide.push(cards[0]);
        rightSide.push(cards[2]);
        rightSide.push(cards[3]);
        let timer = 0;

        if (window.pageYOffset > 318) {

            for (let index = 0; index < 2; index++) {

                setTimeout(() => {
                    leftSide[index].style = "transform: translateX(0); transition: 5s";
                    rightSide[index].style = "transform: translateX(0); transition: 5s";
                }, timer);
                timer += 1500;
            }

        } else {
            cards[0].style = "transform: translateX(-130%)";
            cards[1].style = "transform: translateX(-240%)";
            cards[3].style = "transform: translateX(130%)";
            cards[2].style = "transform: translateX(240%)";
        }
    }


}