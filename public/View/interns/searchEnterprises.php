
<?php
$skills = $this->var["Skills"];
$activitiesArea = $this->var["ActivityArea"];
?>
<form action="" method="post">
    <select name="activity" class="form-control selectpicker" data-style="btn btn-link" id="activitySelect">
        <option value="">Choississez un secteur d'activité</option>
        <?php
        $activitiesArea = $this->var["ActivityArea"];
        foreach ($activitiesArea as $activityArea) : ?>
            <option value="<?= $activityArea->id ?>"> <?php echo $activityArea->name; ?> </option>
        <?php
        endforeach;
        ?>
    </select>

    <select name="skill" class="form-control selectpicker" data-style="btn btn-link" id="skillSelect">
        <option value="">Choississez une compétence</option>
        <?php foreach ($skills as $skill) : ?>
            <option value="<?= $skill->id ?>"> <?= $skill->name; ?></option>
        <?php endforeach; ?>
    </select>


    <select name="dpt" class="form-control selectpicker">
        <optgroup id="dptoptgrp" label="Votre département">

        </optgroup>
    </select>
    <button class="btn">Rechercher</button>

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

</form>
