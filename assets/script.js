// DARK MODE
function dark_mode(){
    const body = document.body;
    if (body.classList.contains("dark_mode")) {
        body.classList.remove("dark_mode")
        localStorage.setItem("theme", "light")
    } else {
        body.classList.add("dark_mode")
        localStorage.setItem("theme", "dark")
    }
}

function save_theme(){
    const savedTheme = localStorage.getItem("theme")
    if (savedTheme === "dark") {
        document.body.classList.add("dark_mode")
    } 
    else {
        document.body.classList.remove("dark_mode")
    }
    }

window.onload = save_theme
//-------------------------------------------------------------------------------------------

//DROPDOWNS
function toggleDropdown_login() {
    const dropdown_login = document.getElementById("dropdown_login")
    const dropdown_activities = document.getElementById("dropdown_activities")

    if (dropdown_activities.classList.contains("show")) {
        dropdown_activities.classList.remove("show")
    }

    dropdown_login.classList.toggle("show");
    }

    function toggleDropdown_act() {
        const dropdown_activities = document.getElementById("dropdown_activities")
        const dropdown_login = document.getElementById("dropdown_login")

        if (dropdown_login.classList.contains("show")) {
            dropdown_login.classList.remove("show")
        }

        dropdown_activities.classList.toggle("show")
    }


    document.addEventListener('click', function(event) {
        const dropdown_login = document.getElementById("dropdown_login")
        const dropdown_activities = document.getElementById("dropdown_activities")

        const isClickInsideLogin = dropdown_login.contains(event.target)
        const isClickInsideActivities = dropdown_activities.contains(event.target)
        const isToggleButton = event.target.closest('a')

        if (!isClickInsideLogin && !isClickInsideActivities && !isToggleButton) {
            dropdown_login.classList.remove("show")
            dropdown_activities.classList.remove("show")
        }
    })

function openComunidade(){
    const username = document.getElementById("usuario").value.trim()
    const password = document.getElementById("senha").value.trim()
    
    if (username == "joao" && password == 1234) {
        open("comunidade.html")
    }
    else{
        alert("usuário ou senha incorretos :(")
    }
}
//-------------------------------------------------------------------------------------------
function imgServicos(){
    open("servicos.html")
}
//-------------------------------------------------------------------------------------------
function comunidade(){
    alert("você não está logado!")
    toggleDropdown_login()
}
//-------------------------------------------------------------------------------------------
function cadastroFic(){
    const form = document.getElementById("section_form")
    const realizado = document.getElementById("cadastro-realizado")

    const username1 = document.getElementById("usuario1").value.trim()
    const password1 = document.getElementById("senha1").value.trim()
    
    if (username1 == "" || password1 == "") {
        
    }
    else{
        form.classList.toggle("hidden")
        realizado.classList.toggle("flex")
        
        setTimeout(function(){
            window.location.href = "index.html"
        }, 2000)
    }
}

