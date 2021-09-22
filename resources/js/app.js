//window.$ = require('jquery');
//require('./bootstrap');


window.addEventListener("scroll", () = > {
    if(document.scrollingElement.scrollTop > 10
)
{
    document.querySelector('body').classList.add("scroll");
}
else
{
    document.querySelector('body').classList.remove("scroll");
}
})
;

// ADD CONTACTS NAVIGATION
function appengHeaderContacts() {
    let div = document.getElementById("contacts");
    if (window.innerWidth < 768) {
        let content = '';
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
window.addEventListener("scroll", () = > {
    if(document.scrollingElement.scrollTop > 10
)
{
    document.querySelector('body').classList.add("scroll");
}
else
{
    document.querySelector('body').classList.remove("scroll");
}
})
;

// OPEN MOBILE MENU
let button = document.querySelectorAll(".button-menu, .overlay");
for (i = 0; i < button.length; i++) {
    button[i].addEventListener("click", () = > {
        document.querySelector("body").classList.toggle("open-menu");
})
    ;
}

