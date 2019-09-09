<?php 
use Model\MatchesModel;
use Model\EnterprisesModel;

$matches = $this->var["matches"]
?>

<div class="container pt-5">
    <div class="card">
        <div class="card-header card_header">
            <a href="profil"><i class="fas fa-chevron-left"></i></a>
            <h3>Mes matchs</h3>
        </div>
        <div class="skill_card">
            <ul class="list-group list-group-flush">
                <?php
                if(!$matches) { ?>
                    <li class="skill_card_li list-group-item col-lg-12">Vous n'avez aucun match pour l'instant</li>
                <?php }
                 foreach ($matches as $match) { 
                    $enterprise = EnterprisesModel::getInstance()->getEnterpriseInfoById($match->enterprise_id) 
                    ?>
                <li class="skill_card_li list-group-item col-lg-12">
                    <div class="col-lg-6">
                        <?= $enterprise->enterprise_name ?>
                    </div>
                    <div>
                        <?= $enterprise->job_title ?>
                    </div>
                    <div>
                        <?php if(MatchesModel::getInstance()->verifMatch($match->id)) { ?>
                            <a href="contact&id=<?= $enterprise->id ?>"><i class="far fa-envelope m-2 mr-4"></i></a>
                        <?php } else {?>
                            <span class="m-2 badge badge-primary">En attente</span>
                        <?php } ?>
                    </div>
                </li>
                <?php } ?>
            <ul>
        </div>
    </div>
</div>
