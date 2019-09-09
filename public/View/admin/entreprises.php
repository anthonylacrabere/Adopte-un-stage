<?php $enterprisesInfos  = $this->var["enterprisesInfos"];?>

<div class="modal_form modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="enterpriseForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter un stagiaire</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row m-2">
                        <label>Nom de l'entreprise :</label>
                        <input class="col-sm-12 form-control" name="enterprise_name" type="text">
                    </div>
                    <div class="form-group row m-2">
                        <label>Email :</label>
                        <input class="col-sm-12 form-control" name="email" type="email">
                    </div>
                    <div class="form-group row m-2">
                        <label>Mot de passe :</label>
                        <input class="col-sm-12 form-control" name="password" type="password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-lg form_btn">Ajouter</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container pt-5">
    <div class="card">
        <div class="card-header card_header">
            <a href="dashboard"><i class="fas fa-chevron-left"></i></a>
            <h3>Entreprises</h3>
            <button class="btn form_btn" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-plus"></i>
            </button>
        </div>
        <div class="skill_card">
            <ul class="list-group list-group-flush">
                <?php foreach ($enterprisesInfos as $enterpriseInfo) : ?>
                <li class="skill_card_li list-group-item col-lg-12">
                    <div class="col-lg-6">
                        <?= "{$enterpriseInfo->enterprise_name}" ?>
                    </div>
                    <div>
                        <a href="entreprises&id=<?= "{$enterpriseInfo->id}" ?>"><i class="far fa-edit mr-1"></i></a>
                    </div>
                </li>
                <?php endforeach; ?>
            <ul>
        </div>
    </div>
</div>


<script type="text/javascript">
    const form = document.querySelector("#enterpriseForm")

    form.addEventListener('submit', e => {
        e.preventDefault()
        
        const myForm = document.querySelector("#enterpriseForm")

        const formData = new FormData(form)

        const data = new URLSearchParams()
        

        for(const p of formData) {
            data.append(p[0], p[1])
        }

        fetch("http://localhost:8888/Adopteunstage-main/public/enterprises/createEnterprise", {
            method: "POST",
            body: data
        }).then(r => {
            // Hide the modal
            $('#exampleModal').modal('hide')

            // Add info bull
            const div = document.createElement('div')
            div.innerHTML = `<div class="infoBulle">Entreprise ajoutée !<div>`
            document.body.appendChild(div)

            // Remove info bulle
            setTimeout(() => {
                document.body.removeChild(div)
            }, 2000)

            return r.json()
        }).then(data => {
                const content = `
                    <div class="col-lg-6">
                        ${data.enterprise_name}
                    </div>
                    <div>
                        <a href="entreprises&id=${data.id}"><i class="far fa-edit mr-1"></i></a>
                    </div>`

                const li = document.createElement('li')
                li.classList.add("skill_card_li")
                li.classList.add("list-group-item")
                li.classList.add("col-lg-12")
                li.innerHTML = content
                const ul = document.querySelector('.list-group')
                ul.prepend(li)
        }).catch(err => console.error(err))
    })
    
</script>