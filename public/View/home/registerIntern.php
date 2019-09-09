<div class="container">
    <div class="form_container_register">
        <h1 class="form_container_connexion">S'inscrire en tant que stagiaire</h1>
        <form method="post">
            <div class="form-row">
                <div class="form-group col-md-12">
                        <!-- TODO cookies pour le form -->
                        <input name="firstname" type="text" aria-label="firstname" class="form-control" 
                        placeholder="<?= isset($_POST["firstname"]) ? $_POST["firstname"]: "Nom"; ?>">
                </div>
                <div class="form-group col-md-12">
                    <input name="lastname" type="text" aria-label="lastname" class="form-control" 
                    placeholder="<?= isset($_POST["lastname"]) ?  $_POST["lastname"] : "Prénom";?>">
                </div>

            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <input name="email" type="email" class="form-control" id="email" 
                    placeholder="<?= isset($_POST["email"]) ?  $_POST["email"] : "Email";?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" checked type="radio" name="gender" id="genderMale" value="h"> Homme
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="f"> Femme
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <input name="password" aria-label="password" type="password" class="form-control" id="password" placeholder="Mot de passe">
                </div>
                <div class="form-group col-md-12">
                    <input name="password_confirm" aria-label="password_confirm" type="password" class="form-control" id="password_confirm" 
                    placeholder="Confirmation du mot de passe">
                    <small class="col-md-12 form-text text-muted pw_help">
                        Votre mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule et un chiffre !
                    </small>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10">
                    <button name="submit" type="submit" class="btn btn-lg form_btn">M'inscrire</button>
                </div>
            </div>
        </form>
    </div>
</div>

