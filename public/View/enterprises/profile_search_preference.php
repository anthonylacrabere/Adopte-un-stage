
<?php
$activitiesArea = $this->var["activitiesArea"];
?>

<div class="container mt-4">
    <div class="form_container_edit">
        <h1 class="form_container_connexion">Préférences de recherches</h1>
        <form action="" method="post">
            <div class="form-group">
                <select name="activity" class="form-control custom-select" data-style="btn btn-link" id="activitySelect">
                    <option value="">Choississez un secteur d'activité</option>
                    <?php
                    foreach ($activitiesArea as $activityArea) : ?>
                        <option value="<?= $activityArea->id ?>"> <?php echo $activityArea->name; ?> </option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group">
                <select name="dpt" class="form-control custom-select">
                    <optgroup id="dptoptgrp" label="Votre département">

                    </optgroup>
                </select>
            </div>

            <button class="btn form_btn btn-lg">Rechercher</button>
        </form>
    </div>
</div>

    <script>
        slct = document.querySelector('#dptoptgrp')

        fetch('https://geo.api.gouv.fr/departements/').then(function (response) {
            response.json().then(function (json) {
                for (let i = 0; i < json.length; i++) {
                    const opt = document.createElement('option')
                    opt.setAttribute('value', json[i].code)
                    opt.textContent = json[i].nom
                    slct.appendChild(opt)
                }
            })
        })
    </script>
