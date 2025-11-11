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
function imgServicos(){
    open("servicos.php") // Atualize para .php se você renomeou o arquivo
}
