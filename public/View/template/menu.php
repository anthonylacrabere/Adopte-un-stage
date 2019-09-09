<?php

use Kernel\Kernel;
use Model\InternsModel;
use Model\AdminModel;


?>


<div id="mySidenav" class="sidenav">
    <a href="javascript:void(0)" id="closebtn" class="closebtn"><i class="fas fa-chevron-right"></i></a>
    <?php 
        if(AdminModel::getInstance()->isConnected()) { 
            if(AdminModel::getInstance()->isAdmin($_SESSION["user_id"])) { ?>
                <a href="../admin/dashboard">Admin panel</a>
            <?php } ?>
                <a href="../<?= InternsModel::getInstance()->isIntern() ? "interns" : "enterprises"?>/home">Swiper</a>
                <a href="../<?= InternsModel::getInstance()->isIntern() ? "interns" : "enterprises"?>/profil"">Mon compte</a>
                <a href="../home/logout"">Deconnexion</a>
    <?php } else { ?>
            <a href="../home/login"">Connexion</a>
            <a href="../home/register"">Inscription</a>
    <?php } ?>
</div>

<nav class="index_nav navbar" id="sectionsNav">
    <div class="container-fluid">
            <a class="navbar-brand" href="
            <?php if(AdminModel::getInstance()->isConnected()) { 
                echo InternsModel::getInstance()->isIntern() ? 'http://localhost:8888/Adopteunstage-main/public/interns/home' : 'http://localhost:8888/Adopteunstage-main/public/enterprises/home';
            } else {
                echo 'http://localhost:8888/Adopteunstage-main/public/';
            } ?>">
                Adopte un stage
            </a>
            <span class="ml-auto" id="openSideNav">
                <i class="fas fa-bars"></i>
            </span>
    </div>
</nav>


<?php

foreach (Kernel::getInstance()->getAlerts() as $key => $value): ?>
    <div class="msg alert alert-<?= $value['type'] ?> text-center">
        <?= "<b>" . $value['message'] . "</b>"?>
    </div>
<?php
endforeach; ?>
