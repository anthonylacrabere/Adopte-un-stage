<div class="swipe_info">
    <p>Bienvenue sur Adopteunstage, voici une liste de profils pouvant t'intéresser.</p>
    <p>Glisse vers l'action de ton choix et si le profil en question fait de même vous pourrez alors lui envoyer un message !</p>
    <div> 
        <input type="checkbox" value="true" id="doNotDisplayAgain">
        <label for="doNotDisplayAgain">Je ne veux plus de votre aide</label>
    </div>
    <button class="swipe_info_button">Fermez cette fenêtre</button>
</div>
<span class="swipe_like_info"><i class="far fa-heart"></i></span>
<span class="swipe_dislike_info"><i class="fas fa-ban"></i></span>

<div class="swiper-container">
    <div class="swiper-wrapper">
        <div class="user_card">
            
        </div>
    </div>
</div>

<script type="text/javascript">

const getEnterprises = async () => {
        const enterprises = await fetch("http://localhost:8888/Adopteunstage-main/public/enterprises/getEnterprises")
        const data = await enterprises.json()

        return data
}

let index = 0;

const createEnterpriseTemplate = () => {
    getEnterprises().then(enterprises => {
        enterprises.forEach(enterprise => {
            const template = `
                <div id="${enterprise.id}" class="demo__card">
                    <img id="user_picture" src="../assets/img/${enterprise.avatar}" alt="">
                    <div class="user_banner">

                    </div>
                    <div class="user_card_body">
                        <div class="user_info">
                            <h2>${enterprise.enterprise_name}</h2>
                            <h3>${enterprise.activity}</h3>
                            <p class="m-3"><i class="fas fa-map-marker-alt mr-2"></i>${enterprise.addresse_name}</p>
                        </div>
                    </div>

                    <div class="user_desc">
                        <h5 class="text-center">${enterprise.job_title}</h5>
                        <hr>

                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="text-center">Description du poste</h5>
                            </div>
                            <p>${enterprise.bio}</p>
                        </div>
                    </div>
                    
                    <div class="demo__card__choice m--reject"></div>
                    <div class="demo__card__choice m--like"></div>
                    <div class="demo__card__drag"></div>
                </div>`

                document.querySelector('.user_card').innerHTML += template
                index++
            })
        })
}

createEnterpriseTemplate(); 


$(document).ready(function() {

var animating = false;
var cardsCounter = 0;
let inputIndex = 0
var numOfCards = index;
var decisionVal = 80;
var pullDeltaX = 0;
var deg = 0;
var $card, $cardReject, $cardLike;

function pullChange() {
    animating = true;
    deg = pullDeltaX / 10;
    $card.css("transform", "translateX("+ pullDeltaX +"px) rotate("+ deg +"deg)");

    var opacity = pullDeltaX / 100;
    var rejectOpacity = (opacity >= 0) ? 0 : Math.abs(opacity);
    var likeOpacity = (opacity <= 0) ? 0 : opacity;
    $cardReject.css("opacity", rejectOpacity);
    $cardLike.css("opacity", likeOpacity);
};

function release() {
    if (index === 1) {
      document.querySelector('.swiper-container').classList.add("d-none")
      document.querySelector('.swipe_like_info').classList.add("d-none")
      document.querySelector('.swipe_dislike_info').classList.add("d-none")

      const reload = document.createElement('i')
      reload.classList.add("fas")
      reload.classList.add("fa-sync")
      reload.classList.add("reload")
      document.querySelector('body').appendChild(reload)

      reload.addEventListener("click", () => {
        window.location = 'http://localhost:8888/Adopteunstage-main/public/interns/home'
      })
    }

    if (pullDeltaX >= decisionVal) {
        const id = $card.attr("id")

        fetch(`http://localhost:8888/Adopteunstage-main/public/interns/likeEnterprise&enterprise_id=${id}&intern_id=${<?= $_SESSION['user_id']?>}`)
        
        $card.addClass("to-right");
    } else if (pullDeltaX <= -decisionVal) {
        const id = $card.attr("id")

        $card.addClass("to-left");
    }

    if (Math.abs(pullDeltaX) >= decisionVal) {
        $card.addClass("inactive");

        setTimeout(function() {
          index--
          $card.addClass("hidden");
        }, 300);
    }

    if (Math.abs(pullDeltaX) < decisionVal) {
        $card.addClass("reset");
    }

    setTimeout(function() {
        $card.attr("style", "").removeClass("reset")
          .find(".demo__card__choice").attr("style", "");

        pullDeltaX = 0;
        animating = false;
    }, 300);
};

$(document).on("mousedown touchstart", ".demo__card:not(.inactive)", function(e) {
    if (animating) return;

    $card = $(this);
    $cardReject = $(".demo__card__choice.m--reject", $card);
    $cardLike = $(".demo__card__choice.m--like", $card);
    var startX =  e.pageX || e.originalEvent.touches[0].pageX;

    $(document).on("mousemove touchmove", function(e) {
        var x = e.pageX || e.originalEvent.touches[0].pageX;
        pullDeltaX = (x - startX);
        if (!pullDeltaX) return;
        pullChange();
    });

    $(document).on("mouseup touchend", function() {
        $(document).off("mousemove touchmove mouseup touchend");
        if (!pullDeltaX) return; // prevents from rapid click events
        release();
    });
});

});

</script>

<script type="text/javascript" src="http://localhost:8888/Adopteunstage-main/public/assets/js/user_info_bulle.js"></script>
<script>
    const displayInfo = document.getElementById("doNotDisplayAgain")
    displayInfo.addEventListener("change", () => {
    setCookie(displayInfo, !displayInfo.value, 365)
    })

    if(getCookie(displayInfo) === "false") {
    swipe_info.classList.add("d-none")
    }
</script>