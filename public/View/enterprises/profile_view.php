<?php
$enterprise = $this->var["enterprise"];
$enterpriseActivity = $this->var["enterpriseActivity"];
$enterpriseAddresse = $this->var["enterpriseAddresse"];
?>
<div class="swipe_info">
    <p>Voici ton profil, tu peux le modifier à tout moment avec la petite icône à coté de ta merveilleuse photo</p>
    <p>Essaie de ne pas mettre n'importe quoi, tout le monde pourra voir ces informations !</p>
    <div>
        <input class="" type="checkbox" id="doNotDisplayAgainProfilBulle">
        <label for="doNotDisplayAgainProfilBulle">Je ne veux plus de votre aide</label>
    </div>
    <button class="swipe_info_button">Fermez cette fenêtre</button>
</div>

<div class="user_card">
    <img id="user_picture" src="../assets/img/<?= $enterprise->avatar; ?>" alt="photo de profil">
    <div class="user_banner">

    </div>
    <div class="user_card_body">
        <a href="profil_edit"><i class="fas fa-user-edit"></i></a>
        <div class="user_info">
            <h2><?=$enterprise->enterprise_name ?></h2>
            <h3><?= $enterpriseActivity->name; ?></h3>
            <p class="m-3"><i class="fas fa-map-marker-alt mr-2"></i><?= $enterpriseAddresse->addresse_name ?></p>
        </div>
    </div>

    <div class="user_desc">
        <h5 class="text-center"><?= $enterprise->job_title ?></h5>
        
        <hr>

        <div class="row">
            <div class="col-lg-12">
                <h5 class="text-center">Description du poste</h5>
            </div>
            <div>
                <p><?= $enterprise->bio; ?></p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="http://localhost:8888/Adopteunstage-main/public/assets/js/user_info_bulle.js"></script>
<script>
    const displayInfo = document.getElementById("doNotDisplayAgainProfilBulle")
        displayInfo.addEventListener("change", () => {
        setCookie("displayInfoBulleProfil", !displayInfo.value, 365)
    })

    if(getCookie("displayInfoBulleProfil") === "false") {
        swipe_info.classList.add("d-none")
    }
</script>