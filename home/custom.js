const adminBtn = document.getElementById("admin");
const adminForm = document.getElementById("admin-form");
const maskDiv = document.getElementById("mask");
const closeAdminForm = document.getElementById("admin-form-close");
const badInp = document.getElementById("bad-input")

adminBtn.addEventListener("click", openForm);
closeAdminForm.addEventListener("click", closeForm)

function openForm(e){
    maskDiv.classList.remove("hidden");
    adminForm.classList.remove("hidden");
}

function closeForm(e){
    maskDiv.classList.add("hidden");
    adminForm.classList.add("hidden");
    badInp.classList.add("hidden");
}
if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
}

function redirectGost(){
    window.location.href = "../redirect/redirect-gost.php";
}