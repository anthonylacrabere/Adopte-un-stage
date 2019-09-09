<?php
$intern = $this->var["intern"];
$internAddresse = $this->var["internAddresse"];
$internActivity = $this->var["internActivity"];
$internSkill = $this->var["internSkill"];
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
    <img id="user_picture" src="../assets/img/<?= $intern->avatar; ?>" alt="photo de profil">
    <div class="user_banner">

    </div>
    <div class="user_card_body">
        <a href="profil_edit"><i class="fas fa-user-edit"></i></a>
        <div class="user_info">
            <h2><?= $intern->firstname . " " . $intern->lastname; ?></h2>
            <h3><?= $internActivity->name; ?></h3>
            <p class="m-3"><i class="fas fa-map-marker-alt mr-2"></i><?= $internAddresse->addresse_name ?></p>
        </div>
    </div>

    <div class="user_desc">
        <div class="row justify-content-center">
                <span class="m-2 badge badge-primary"><?= $internSkill->name ?></span>
        </div>

        <hr>

        <div class="row">
            <div class="col-lg-12">
                <h5 class="text-center">Description</h5>
            </div>
            <p class="col-lg-12"><?= $intern->speech; ?></p>
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