<div class="container">
    <div class="form_container_register">
        <h1 class="form_container_connexion">S'inscrire en tant qu'entreprise</h1>
        <form method="post">
            <div class="form-row">
                <div class="form-group col-md-12">
                        <!-- TODO cookies pour le form -->
                        <input name="enterprise_name" type="text" aria-label="enterprise_name" class="form-control" placeholder="Nom de votre entreprise">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <input name="email" type="email" class="form-control" id="email" placeholder="Email">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <input name="password" aria-label="password" type="password" class="form-control" id="password" placeholder="Mot de passe">
                </div>
                <div class="form-group col-md-12">
                    <input name="password_confirm" aria-label="password_confirm" type="password" class="form-control" id="password_confirm" placeholder="Confirmation du mot de passe">
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

