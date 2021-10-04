//window.$ = require('jquery');
//require('./bootstrap');
require('inputmask');



window.addEventListener("scroll", function () {
    if (document.scrollingElement.scrollTop > 10) {
        document.querySelector('body').classList.add("scroll");
    } else {
        document.querySelector('body').classList.remove("scroll");
    }
});

// ADD CONTACTS NAVIGATION
/*function appengHeaderContacts() {
    var div = document.getElementById("contacts");
    if (window.innerWidth < 768) {
        var content = '';
        content += '<div class="js-contacts">';
        content += '    <div class="js-contacts__phone">+7 (495) 555-33-99</div>';
        content += '    <div class="js-contacts__phone">+7 (915) 444-33-99</div>';
        content += '    <div class="button">Оставить заявку</div>';
        content += '    <div class="js-contacts__links">';
        content += '        <a href="#">IG</a>';
        content += '        <a href="#">VK</a>';
        content += '        <a href="#">FB</a>';
        content += '    </div>';
        content += '</div>';

        div.innerHTML = content;
    } else {
        div.innerHTML = '';
    }
}

appengHeaderContacts();
window.addEventListener("resize", appengHeaderContacts);

// SCROLL PAGE
window.addEventListener("scroll", function () {
    if (document.scrollingElement.scrollTop > 10) {
        document.querySelector('body').classList.add("scroll");
    } else {
        document.querySelector('body').classList.remove("scroll");
    }
});

// OPEN MOBILE MENU
var button = document.querySelectorAll(".button-menu, .overlay");
for (i = 0; i < button.length; i++) {
    button[i].addEventListener("click", function () {
        document.querySelector("body").classList.toggle("open-menu");
    });
}

*/

// CONTACT FORM

var phoneInputs = document.getElementsByName("phone");
for (i = 0; i < phoneInputs.length; i++) {
   Inputmask({"mask": "+7 (999) 999-9999"}).mask(phoneInputs[i]);
}






function validateForm(form) {
    var requiredInputs = form.querySelectorAll("[required]");
    var result = true;
    for (i = 0; i < requiredInputs.length; i++) {
        if(requiredInputs[i].value === "" || requiredInputs[i].value.length < 3) {
            requiredInputs[i].classList.add('error');
            result = false;
        } else {
            requiredInputs[i].classList.remove('error');
        }
    }
    return result;
}

function sendForm() {
    var url = '/send';
    var token = document.head.querySelector("[name=csrf-token]").content;

    var xhttp = new XMLHttpRequest;
    var data = {
        _token: token,
        name: 'Имя',
        phone: 'Телефон'
    };

    xhttp.open('POST', url, true);
    xhttp.setRequestHeader('X-CSRF-TOKEN', token);
    xhttp.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded; charset=UTF-8');
    xhttp.send(data);
}



var form = document.getElementById("contact-form");
form.addEventListener('submit', function (event) {
    event.preventDefault();
    if(validateForm(form))
        sendForm();
});



