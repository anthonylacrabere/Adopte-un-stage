<?php
$enterprise = $this->var["enterprise"];
$enterpriseAddresse = $this->var["enterpriseAddresse"];

$activitiesArea = $this->var["activitiesArea"];
$enterpriseActivity = $this->var["enterpriseActivity"];
?>

<div class="container mt-4">
    <div class="form_container_edit">
        <h1 class="form_container_connexion">Modifier mon profil</h1>
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="form-group col-lg-6">
                    <label>Nom de votre entreprise</label>
                    <input value="<?= $enterprise->enterprise_name ?>" name="enterprise_name" class="form-control" placeholder="Nom de votre entreprise">
                </div>
                <div class="form-group col-lg-6">
                        <label>Portable</label>
                        <input value="<?= $enterprise->phone?>" name="phone" class="form-control" placeholder="Numéro de téléphone de l'entreprise">
                </div>
            </div>

            <div class="form-group">
                <label for="activitySelect">Secteur d'activité</label>

                <select name="activity" class="form-control custom-select" data-style="btn btn-link" id="activitySelect">
                    <option value="">Choississez un secteur d'activité</option>
                    <?php
                    foreach ($activitiesArea as $activityArea) : ?>
                        <option <?php if($enterpriseActivity) { if ($enterpriseActivity->name === $activityArea->name) : echo "selected"; endif; }?> value="<?= $activityArea->id ?>"> <?php echo $activityArea->name; ?> </option>
                    <?php
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="addresse">Localisation</label>

                <input type="search" class="form-control" name="addresse" id="addresse" value="<?= $enterpriseAddresse ? $enterpriseAddresse->addresse_name: "Ajouter votre localisation" ?>" />
            </div>

            <div class="form-group">
                <label for="enterprise_job_title">Intitulé du poste</label>
                <input name="enterprise_job_title" id="enterprise_job_title" class="form-control" value="<?= $enterprise->job_title ?>" placeholder="Ajouter l'intitulé du poste">
            </div>

            <div class="form-group">
                <label for="enterprise_bio">Description du poste</label>
                <textarea name="enterprise_bio" id="enterprise_bio" cols="30" rows="5" class="form-control"><?= $enterprise->bio?></textarea>
            </div>

            <div class="row">
                <div class="form-group col-lg-6">
                    <label>Ajouter une photo</label>
                    <input type="file" name="avatar" value="upload" accept="image/*" class="form-control">
                </div>
                <div class="form-group col-lg-6 col-md-12">
                    <img class="profil_edit_avatar" src="http://localhost:8888/Adopteunstage-main/public/assets/img/<?= $enterprise->avatar; ?>" alt="photo de profil actuel">
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