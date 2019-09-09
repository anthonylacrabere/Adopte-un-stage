<?php $skills  = $this->var["skills"];?>

<div class="modal_form modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="skillForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajouter une compétence</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="form-group row m-2">
                            <label class="col-form-label">Nom</label>
                            <input class="col-sm-12 form-control" id="skillName" name="skillName" type="text">
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
            <h3>Compétences</h3>
            <button class="btn form_btn" href="" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-plus"></i>
            </button>
        </div>
        <div class="skill_card">
            <ul class="list-group list-group-flush">
                <?php foreach ($skills as $skill) : ?>
                <li class="skill_card_li list-group-item col-lg-12">
                    <div class="col-lg-6"><?= $skill->name ?></div>
                    <div>
                        <a id="<?= $skill->id ?>"><i class="far fa-trash-alt mr-2"></i></i></a>
                    </div>
                </li>
                <?php endforeach; ?>
            <ul>
        </div>
    </div>
</div>

<script type="text/javascript">
    const links = document.querySelectorAll(".fa-trash-alt")

    links.forEach(el => {
        el.addEventListener("click", e => {
            id = el.parentElement.id

            fetch(`http://localhost:8888/Adopteunstage-main/public/skill/deleteSkill&id=${id}`, {
                method: "DELETE",
            }).then( () => {
                // Delete the nodes where my <li> is
                const listgroup = document.querySelector(".list-group")
                listgroup.removeChild(el.offsetParent)
            }).catch(err => {
                console.error(err)
            })

            e.preventDefault();
        })
    })

    const form = document.querySelector("#skillForm")

    form.addEventListener('submit', e => {
        e.preventDefault()

        const formData = new FormData(form)

        const data = new URLSearchParams();
        

        for(const p of formData) {
            data.append(p[0], p[1])
        }

        fetch("http://localhost:8888/Adopteunstage-main/public/skill/addSkill", {
            method: "POST",
            body: data
        }).then(r => {
            // Hide the modal
            $('#exampleModal').modal('hide')

            // Add info bull
            const div = document.createElement('div')
            div.innerHTML = `<div class="infoBulle">Compétence ajoutée<div>`
            document.body.appendChild(div)

            // Remove info bulle
            setTimeout(() => {
                document.body.removeChild(div)
            }, 2000)

            return r.json()
        }).then(data => {
            console.log(data)
            const content = `
            <div class="col-lg-6">
                ${data.name}
            </div>
            <div>
                <a id="${data.id}"><i class="far fa-trash-alt mr-2"></i></i></a>
            </div>`

            const li = document.createElement('li')
            li.classList.add("skill_card_li")
            li.classList.add("list-group-item")
            li.classList.add("col-lg-12")
            li.innerHTML = content
            const ul = document.querySelector('.list-group')
            ul.prepend(li)

            
            const links = document.querySelectorAll(".fa-trash-alt")

            links.forEach(el => {
                el.addEventListener("click", e => {

                fetch(`http://localhost:8888/Adopteunstage-main/public/skill/deleteSkill&id=${data.id}`, {
                    method: "DELETE"
                }).then( () => {
                    // Delete the nodes where my <li> is
                    const listgroup = document.querySelector(".list-group")
                    listgroup.removeChild(el.offsetParent)

                    // Add info bull
                    const div = document.createElement('div')
                    div.innerHTML = `<div class="infoBulle">Compétence supprimée<div>`
                    document.body.appendChild(div)

                    // Remove info bulle
                    setTimeout(() => {
                    document.body.removeChild(div)
                    }, 2000)
                }).catch(err => {
                    console.error(err)
                })

                e.preventDefault();
                })
            })

        })
        .catch(err => console.error(err))

    })
    
</script>
