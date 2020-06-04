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
    modal.classList.remove("hidden");
    mask.classList.remove("hidden");
}

function hideModal() {
    modal.classList.add("hidden");
    mask.classList.add("hidden");
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

/*
17
setInterval(() => {
    console.log("doc - ", document.body.clientWidth);
    console.log("wind - ", window.innerWidth);
    console.log(window.innerWidth - document.body.clientWidth);
}, 1000)
*/