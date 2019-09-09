<?php $enterprise = $this->var["enterprise"];?>

<div class="container pt-5">
    <div class="card">
        <div class="card-header card_header">
            <a href="entreprises"><i class="fas fa-chevron-left"></i></a>
        </div>
        <div class="skill_card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">id : <?= $enterprise->id ?></li>
                <li class="list-group-item">firstname : <?= $enterprise->enterprise_name ?></li>
                <li class="list-group-item">email : <?= $enterprise->email ?></li>
                <li class="list-group-item">phone : <?= $enterprise->phone ?></li>
                <li class="list-group-item">job_title : <?= $enterprise->job_title ?></li>
                <li class="list-group-item">description : <?= $enterprise->bio ?></li>
                <li class="list-group-item">verified : <?= $enterprise->verified ?></li>
                <li class="list-group-item">avatar : <?= $enterprise->avatar ?></li>
                <li class="list-group-item">register date : <?= $enterprise->register_date ?></li>
                <li class="list-group-item">
                    <div>
                        <button class="btn btn-danger" id="<?= $enterprise->id ?>">Supprimer</button>
                    </div>
                </li>
            <ul>
           
        </div>
    </div>
</div>

<script>
    const btn = document.querySelector(".btn-danger")


    btn.addEventListener("click", e => {
        id = btn.id
        console.log(id)

        fetch(`http://localhost:8888/Adopteunstage-main/public/enterprises/deleteEnterprise&id=${id}`, {
            method: "DELETE",
        }).then( () => {
            window.location = "http://localhost:8888/Adopteunstage-main/public/admin/entreprises"
        }).catch(err => {
            console.error(err)
        })

        e.preventDefault();
    })

</script>