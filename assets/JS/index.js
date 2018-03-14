var loglink = document.getElementById("login");
if(sessionStorage.getItem("userid") != null){
    loglink.innerHTML = "Gérer mon compte";
}