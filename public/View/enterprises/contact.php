<div class="container mt-4">
    <div class="card">
        <div class="card-header text-center">Envoyer un message</div>
        <div class="card-body overflow_scroll">
            
        </div>
        <div class="card-footer">
            <form action="" class="row">
                <input type="text" name="mp" class="form-control col-md-12 mb-3">
                <input type="submit" class="btn form_btn col-md-4 m-auto" value="Envoyer message">
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    const btn = document.querySelector(".btn")
    const input = document.querySelector("input")
    const form = document.querySelector("form")

    btn.addEventListener("click", e => {
        e.preventDefault()

        const formData = new FormData(form)

        const data = new URLSearchParams();


        for(const p of formData) {
            data.append(p[0], p[1])
        }
        
        fetch(`http://localhost:8888/Adopteunstage-main/public/Mp/createMp&id=${<?=$_GET["id"]?>}`, {
            method: "POST",
            body: data
        }).then( r => {
            input.value =''
            document.location.reload(true)
            return r.json()
        })
    })

    const getMp = async () => {
        const mp = await fetch(`http://localhost:8888/Adopteunstage-main/public/Mp/getMp&id=${<?=$_GET["id"]?>}`)
        .then(response => response.json())
        .then(json => json);

        return mp
    }

    const displayMp = async () => {
        const mp = await getMp();
        mp.forEach(r => {
            container = document.querySelector(".card-body")
            if(r.exp == <?= $_SESSION["user_id"]?>) {
                container.innerHTML += `<h4 class="text-right">Moi : </h4><p class="text-right border pr-2">${r.message}</p>`
            } else {
                container.innerHTML += `<h4>Stagiaire : </h4><p class="text-left border pl-2">${r.message}</p>`
            }
            console.log(r.message);
        })
    }

    displayMp();
</script>