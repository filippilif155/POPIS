const ntfcRadio = document.getElementById("ntfc");
const censusRadio = document.getElementById("census");
const ntfcRadioDiv = document.getElementById("ntfc-div");
const censusRadioDiv = document.getElementById("census-div");
const notificationsDivList = document.getElementsByClassName("notification");
const modal = document.getElementById("modal");
const modalJmbg = document.getElementById("modal-jmbg");
const modalReq = document.getElementById("modal-request");
const modalContact = document.getElementById("modal-contact");
const modalTxt = document.getElementById("modal-text");
const mask = document.getElementById("mask");
const refuseBtn = document.getElementById("refuse");
const allowBtn = document.getElementById("allow");
refuseBtn.addEventListener("click", refuseReq);
allowBtn.addEventListener("click", allowReq);
ntfcRadio.addEventListener("click", showDocument);
censusRadio.addEventListener("click", showDocument);

for (let i = 0; i < notificationsDivList.length; i++) {
    notificationsDivList[i].addEventListener("click", showModal);
}

function showModal(e) {
    var list;
    if (e.target.classList.contains("notification")) {
        list = e.target.children;
    } else {
        list = e.target.parentNode.children;
    }
    modalJmbg.innerHTML = "JMBG: " + list[0].innerHTML;
    modalReq.innerHTML = "ZAHTJEV: " + list[1].innerHTML;
    modalContact.innerHTML = "KONTAKT: " + list[2].innerHTML;
    modalTxt.innerHTML = "OBRAZLOŽENJE: " + list[3].innerHTML;
    if (list[1].innerHTML === "DRUGO") {
        allowBtn.classList.add("disabled");
    }
    modal.classList.remove("hidden");
    mask.classList.remove("hidden");
}

function hideModal() {
    modal.classList.add("hidden");
    mask.classList.add("hidden");
    if (allowBtn.classList.contains("disabled")) {
        allowBtn.classList.remove("disabled");
    }
}

function showDocument(event) {
    let eventId = event.target.id;
    if (eventId === "ntfc") {
        censusRadioDiv.classList.add("hidden");
        ntfcRadioDiv.classList.remove("hidden");
    } else {
        censusRadioDiv.classList.remove("hidden");
        ntfcRadioDiv.classList.add("hidden");
    }
}



function refuseReq(event) {
    let jmbg = event.target.parentNode.children[0].innerHTML.substring(6);
    var formData = new FormData();
    formData.append("jmbg", jmbg);
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            response = this.responseText;
            if (response) {
                hideModal();
                for (let i = 0; i < notificationsDivList.length; i++) {
                    if (jmbg === notificationsDivList[i].children[0].innerHTML) {
                        notificationsDivList[i].parentNode.removeChild(notificationsDivList[i]);
                    }
                }
                alert("Uspješno obrisan zahtjev!");
            } else {
                alert("Došlo je do greške! Pokušajte ponovo!");
            }
        }
    };
    request.open("POST", "delete_ntfc.php");
    request.send(formData);
}

function allowReq(event) {
    let jmbg = event.target.parentNode.children[0].innerHTML.substring(6);
    let req = event.target.parentNode.children[1].innerHTML.substring(9);
    if (req !== "DRUGO") {
        var formData = new FormData();
        formData.append("jmbg", jmbg);
        formData.append("request", req);
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                response = this.responseText;
                if (response) {
                    hideModal();
                    for (let i = 0; i < notificationsDivList.length; i++) {
                        if (jmbg === notificationsDivList[i].children[0].innerHTML) {
                            notificationsDivList[i].parentNode.removeChild(notificationsDivList[i]);
                        }
                    }
                    alert("Uspješno obrisan zahtjev!");
                } else {
                    alert("Došlo je do greške! Pokušajte ponovo!");
                }
            }
        }

        request.open("POST", "resolve_ntfc.php");
        request.send(formData);
    } else {
        hideModal();
    }
}