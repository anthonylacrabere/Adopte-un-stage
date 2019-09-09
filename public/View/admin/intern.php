<?php $intern = $this->var["intern"];?>

<div class="container pt-5">
    <div class="card">
        <div class="card-header card_header">
            <a href="interns"><i class="fas fa-chevron-left"></i></a>
        </div>
        <div class="skill_card">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">id : <?= $intern->id ?></li>
                <li class="list-group-item">firstname : <?= $intern->firstname ?></li>
                <li class="list-group-item">lastname : <?= $intern->lastname ?></li>
                <li class="list-group-item">email : <?= $intern->email ?></li>
                <li class="list-group-item">gender : <?= $intern->gender ?></li>
                <li class="list-group-item">age : <?= $intern->age ?></li>
                <li class="list-group-item">phone : <?= $intern->phone ?></li>
                <li class="list-group-item">speech : <?= $intern->speech ?></li>
                <li class="list-group-item">avatar : <?= $intern->avatar ?></li>
                <li class="list-group-item">verified : <?= $intern->verified ?></li>
                <li class="list-group-item">register date : <?= $intern->register_date ?></li>
                <li class="list-group-item">
                    <div>
                        <button class="btn btn-danger" id="<?= $intern->id ?>">Supprimer</button>
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

        fetch(`http://localhost:8888/Adopteunstage-main/public/interns/deleteIntern&id=${id}`, {
            method: "DELETE",
        }).then( () => {
            window.location = "http://localhost:8888/Adopteunstage-main/public/admin/interns"
        }).catch(err => {
            console.error(err)
        })

        e.preventDefault();
    })

</script>