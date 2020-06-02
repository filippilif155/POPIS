var respDate;
const idTime = document.getElementById("time");
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        respDate = new Date(this.responseText);
        resolveDate();
    }
};
xmlhttp.open("GET", "time.php", true);
xmlhttp.send();

function getDaysString(num) {
    let strDesc;
    if (num === 0) {
        return "";
    } else if ((num === 1 || num % 10 === 1) && num !== 11) {
        strDesc = "dan";
    } else {
        strDesc = "dana";
    }

    return num + " " + strDesc + " ";


}

function getHoursString(num) {
    let strDesc;
    if (num === 0) {
        return "";
    } else if ((num >= 10 && num <= 20) || num % 10 === 0 || (num % 10 >= 5 && num % 10 <= 9)) {
        strDesc = "sati";
    } else if (num === 1 || num % 10 === 1) {
        strDesc = "sat";
    } else {
        strDesc = "sata";
    }

    return num + " " + strDesc + " ";


}

function getMinutesString(num) {
    let strDesc;
    if (num === 0) {
        return "";
    } else if ((num === 1 || num % 10 === 1) && num !== 11) {
        strDesc = "minut";
    } else {
        strDesc = "minuta";
    }

    return num + " " + strDesc;
}

function resolveDate() {
    function resolve() {
        let today = new Date();
        timeLeft = respDate - today;
        let days = timeLeft / 1000 / 3600 / 24;
        let hours = (days * 1000 * 3600 * 24 - Math.floor(days) * 1000 * 3600 * 24) / 1000 / 3600;
        days = Math.floor(days);
        let minutes = (hours * 1000 * 3600 - Math.floor(hours) * 1000 * 3600) / 1000 / 60;
        hours = Math.floor(hours);
        minutes = Math.floor(minutes);
        idTime.innerHTML = getDaysString(days) + getHoursString(hours) + getMinutesString(minutes);
    }
    resolve();
    setInterval(resolve, 5000);
}

const numOfFields = document.getElementById("num-of-fields");
const jmbgDiv = document.getElementById("jmbg-cont");

function validateDomForm() {
    var jmbgList = jmbgDiv.children;
    var checker = 0;
    var regex = new RegExp("[0-9]");


    function wrongInput(i, str = "Pogrešan unos!") {
        jmbgList[i].value = "";
        jmbgList[i].placeholder = str;
        jmbgList[i].classList.add("warning");
        checker = 1;
    }

    for (let i = 0; i < jmbgList.length; i++) {
        let elem = jmbgList[i].value;
        if (elem.length != 13) {
            wrongInput(i);
            continue;
        }

        if (!regex.test(elem)) {
            wrongInput(i);
            continue;
        }

        for (let j = i - 1; j >= 0; j--) {
            console.log(elem + " - " + jmbgList[j].value);
            if (elem === jmbgList[j].value) {
                wrongInput(i, "Duplikat!");
                continue;
            }
        }
    }
    if (checker === 0) {
        return true;
    } else {
        event.preventDefault();
        return false;
    }
}

const indInput = document.getElementById("jmbg");

function validateIndForm() {
    var regex = new RegExp("[0-9]");
    if (indInput.value.length !== 13 || !regex.test(indInput.value)) {
        indInput.value = "";
        indInput.placeholder = "Pogrešan unos!";
        indInput.classList.add("warning");
        event.preventDefault();
    }
}


numOfFields.addEventListener("input", makeBoxes)

function makeBoxes(e) {
    var num = e.target.value;
    if (num >= 1 && num <= 14) {
        while (jmbgDiv.firstChild) {
            jmbgDiv.removeChild(jmbgDiv.lastChild);
        }

        for (let i = 0; i < num; i++) {
            let box = document.createElement("input");
            box.type = "number";
            box.name = `jmbg-${i}`;
            box.id = `jmbg-${i}`;
            box.className = "box";
            box.required = true;
            box.placeholder = "Upišite JMBG";
            jmbgDiv.appendChild(box);
        }
    }

}
const domFormDiv = document.getElementById("dom");
const indFormDiv = document.getElementById("ind");
const mask = document.getElementById("mask");
const domBtn = document.getElementById("show-dom-form");
const indBtn = document.getElementById("show-ind-form");
const domBtnClose = document.getElementById("dom-close");
const indBtnClose = document.getElementById("ind-close");
const htmlErrorDiv = document.getElementById("html-error");
const htmlErrorBtn = document.getElementById("error-close");
domBtn.addEventListener("click", showForm);
indBtn.addEventListener("click", showForm);
indBtnClose.addEventListener("click", closeForm);
domBtnClose.addEventListener("click", closeForm);
htmlErrorBtn.addEventListener("click", closeForm);

function showForm(e) {
    if (e.target.id === "show-dom-form") {
        domFormDiv.classList.remove("hidden");
    } else {
        indFormDiv.classList.remove("hidden");
    }
    mask.classList.remove("hidden");
}

function closeForm(e) {
    if (e.target.id === "dom-close") {
        domFormDiv.classList.add("hidden");
    } else if (e.target.id === "error-close") {
        htmlErrorDiv.classList.add("hidden");
    } else {
        indFormDiv.classList.add("hidden");
    }
    mask.classList.add("hidden");
}