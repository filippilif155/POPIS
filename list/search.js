var slider = document.getElementById('slide')
var next = document.getElementById('next')
var prev = document.getElementById('prev');



var counter = 0;
var w = 0;
var wold = window.innerWidth;
displayWindowSize()
window.addEventListener("resize", displayWindowSize);

function displayWindowSize() { //want to chekc width after every change 
    w = document.documentElement.clientWidth;
    // Display result inside a div element
    if (w != wold) { //want to check if width is changed 
        wold = w;
        wchange();
    }
}

function gonext() {

    var vis = document.querySelectorAll('.visibleslide')
    if (counter >= vis.length - 1) {
        counter = -1;
    }
    counter++
    for (i = 0; i < vis.length; i++) {
        vis[i].style.transition = 'transform 0.8s ease-in-out'
        vis[i].style.transform = 'translateX(' + (-counter * slider.offsetWidth) + "px)";
    }
    if (counter == vis.length - 1) {
        counter = -1;
    }
}

function goprev() {

    var vis = document.querySelectorAll('.visibleslide')
    if (counter < 1) {
        counter = vis.length;
    }
    counter--
    for (i = 0; i < vis.length; i++) {
        vis[i].style.transition = 'transform 0.8s ease-in-out'
        vis[i].style.transform = 'translateX(' + (-counter * slider.offsetWidth) + "px)";
    }

}

var myVar = setInterval(gonext, 10000)
wchange()

function wchange() {
    if (w > 600) {

        next.addEventListener('click', gonext);
        prev.addEventListener('click', goprev)
        clearInterval(myVar)
        myVar = setInterval(gonext, 10000)
    } else {
        clearInterval(myVar)
    }
}
const subbtn = document.getElementById('submitbtn')
subbtn.disabled = true;
subbtn.className = 'disable';
var checkbox = document.querySelectorAll('.item input');
[...checkbox].forEach(elem => {
    elem.addEventListener('change', () => {
        if (elem.checked) {
            // Dodati style clasu sta god
            elem.parentNode.style.backgroundColor = ' rgb(47, 87, 87)'
            subbtn.disabled = false;
            subbtn.className = 'active';

        } else {
            // Checkbox is not checked..
            elem.parentNode.style.backgroundColor = '#FAF0DC'
            checkother()
        }

    })
});
[...checkbox].forEach(elem => {
    if (elem.checked) {
        // Dodati style clasu sta god
        elem.parentNode.style.backgroundColor = ' rgb(47, 87, 87)'
        subbtn.disabled = false;
        subbtn.className = 'active';

    } else {
        // Checkbox is not checked..
        elem.parentNode.style.backgroundColor = '#FAF0DC'
        checkother()
    }

})
checkother()

function checkother() {
    let br = 0;
    const checkbox2 = document.querySelectorAll('.item input');
    [...checkbox].forEach(elem => {
        if (elem.checked) {
            subbtn.disabled = false;
            subbtn.className = 'active';
            br++;
        }
        if (br == 0) {
            subbtn.disabled = true;
            subbtn.className = 'disable';
        }
    })

}