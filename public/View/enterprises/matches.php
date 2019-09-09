<?php 
    use Model\MatchesModel;
    use Model\InternsModel;
    $matches = $this->var["matches"];
?>

<div class="container pt-5">
    <div class="card">
        <div class="card-header card_header">
            <a href="profil"><i class="fas fa-chevron-left"></i></a>
            <h3>Mes matchs</h3>
            <button class="btn form_btn" href="" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-plus"></i>
            </button>
        </div>
        <div class="skill_card">
            <ul class="list-group list-group-flush">
            <?php
                if(!$matches) { ?>
                    <li class="skill_card_li list-group-item col-lg-12">Vous n'avez aucun match pour l'instant</li>
                <?php }
                    foreach ($matches as $match) {
                    $intern = InternsModel::getInstance()->getInternInfoById($match->intern_id) 
                    ?>
                <li class="skill_card_li list-group-item col-lg-12">
                    <div class="col-lg-6">
                       <?= $intern->firstname . " " . $intern->lastname ?>
                    </div>
                    <div>
                        <?php if(MatchesModel::getInstance()->verifMatch($match->id)) { ?>
                            <a href="contact&id=<?= $intern->id ?>"><i class="far fa-envelope m-2 mr-4"></i></a>
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
