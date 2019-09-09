<?php
$intern = $this->var["intern"];
$internAddresse = $this->var["internAddresse"];
$internActivity = $this->var["internActivity"];
$internSkill = $this->var["internSkill"];
$internQualificationsLevel = $this->var["internQualificationsLevel"];

$skills = $this->var["skills"];
$activitiesArea = $this->var["activitiesArea"];
$qualificationsLevel = $this->var['qualificationsLevel'];
?>
<div class="container mt-4">
    <div class="form_container_edit">
        <h1 class="text-center">Modifier mon profil</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="">Prénom</label>
                    <input value="<?= $intern->firstname ?>" name="firstname" class="form-control" placeholder="Votre prénom">
                </div>

                <div class="form-group col-md-6">
                    <label for="">Nom</label>
                    <input id="first" value="<?= $intern->lastname ?>" name="lastname" class="form-control" placeholder="Votre nom">
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-8">
                    <label>Portable</label>
                    <input value="<?= $intern->phone?>" name="phone" class="form-control" placeholder="Votre portable">
                </div>

                <div class="form-group col-md-4">
                    <label>Age</label>
                    <input value="<?= $intern->age?>" name="age" class="form-control" placeholder="Âge">
                </div>
                
            </div>
            

            <div class="form-group">
                <label for="activitySelect">Secteur d'activité</label>

                <select name="activity" class="form-control custom-select" data-style="btn btn-link" id="activitySelect">
                    <option value="">Choississez un secteur d'activité</option>
                    <?php
                    foreach ($activitiesArea as $activityArea) : ?>
                        <option <?php if($internActivity) { if ($internActivity->name === $activityArea->name) : echo "selected"; endif; }?> 
                        value="<?= $activityArea->id ?>"> <?php echo $activityArea->name; ?> </option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="qualificationLevelSelect">Niveau d'étude</label>
                    <select name="qualificationLevel" class="form-control custom-select" data-style="btn btn-link"  id="qualificationLevelSelect">
                        <option value="">Choississez un niveau d'étude</option>
                        <?php
                        foreach ($qualificationsLevel as $level) : ?>
                            <option <?php if($internQualificationsLevel) { if ($internQualificationsLevel->level === $level->level) : echo "selected"; endif;} ?> 
                            value="<?= $level->id ?>"> <?php echo $level->level; ?> </option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="skillSelect">Compétences</label>

                    <select name="skill" class="form-control custom-select" data-style="btn btn-link" id="skillSelect">
                        <option value="">Choisissez une compétence</option>
                        <?php foreach ($skills as $skill) : ?>
                                <option <?php if($internSkill) { if ($internSkill->name === $skill->name) : echo "selected"; endif;} ?> 
                                value="<?= $skill->id ?>"> <?= $skill->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="addresse">Localisation</label>

                <input type="search" class="form-control" name="addresse" id="addresse" value="<?= $internAddresse ? $internAddresse->addresse_name: "Ajouter votre localisation" ?>" />
            </div>

            <div class="form-group">
                <label for="user_speech">Informations</label>
                <textarea name="user_speech" id="user_speech" cols="30" rows="5" class="form-control"><?= $intern->speech?></textarea>
            </div>

            <div class="row">
                <div class="form-group col-lg-6">
                    <label>Ajouter une photo</label>
                    <input type="file" name="avatar" value="upload" accept="image/*" class="form-control">
                </div>
                <div class="form-group col-lg-6 col-md-12">
                    <img class="profil_edit_avatar" src="http://localhost:8888/Adopteunstage-main/public/assets/img/<?= $intern->avatar; ?>" alt="photo de profil actuel">
                </div>
            </div>
           

            <input class="btn btn-lg form_btn" type="submit" name="submit" placeholder="Envoyer">
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/places.js@1.16.4"></script>
<script>
    const fixedOptions = {
        appId: 'plN9ZGL2VLXE',
        apiKey: '4a4f384c9f310e00d6dad26fe8fa333a',
        container: document.querySelector('#addresse'),
        language: 'fr',
        countries: ['fr', 'lu'],
        type: 'city',
        aroundLatLngViaIP: true,
    }

    const placesAutocomplete = places(fixedOptions)


</script>