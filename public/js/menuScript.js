main();

function main() {
    setupNavBarHobbiesDropdownMenu();
    setupNavBarLightUpAndEnhancement();
    setupMenuClock();
    setInterval(updateMenuClock, 1000);
}

function setupNavBarLightUpAndEnhancement() {
    $('#navList').children().children().add($('.dropdownMenu').children().children()).mouseenter(function() {
        $(this)
            .css('color', 'gold')
            .css('fontSize', 'large');
    });

    $('#navList').children().children().add($('.dropdownMenu').children().children()).mouseleave(function() {
        $(this)
            .css('color', 'rgb(255, 175, 63)')
            .css('fontSize', 'medium');
    });
}

function setupNavBarHobbiesDropdownMenu() {
    let dropdownMenu = $('<ul class="dropdownMenu"></ul>').hide();
    
    dropdownMenu
        .append($('<li> <a href="../pageHobbies/hobbiesPage.html#mangaLN"> Манга/Ранобэ </a> </li>'))
        .append($('<li> <a href="../pageHobbies/hobbiesPage.html#videogames"> Видеоигры </a> </li>'));
    
    $('#hobbiesDropdownMenu')
        .append(dropdownMenu)
        .mouseenter(function() {
            $('.dropdownMenu').show(100);
        })
        .mouseleave(function() {
            $('.dropdownMenu').hide(100);
        });

    $('.dropdownMenu').mouseleave(function() {
        $(this).hide(100);
    });
}

function setupMenuClock() {
    let time = new Date();
    $('#navList').append($('<li id="clock">' + time.getHours() + ":" + time.getMonth() + ":" + time.getFullYear() + "</li>"));
}

function updateMenuClock() {
    let time = new Date()
    $('#clock').text(time.getHours() + ":" + time.getMonth() + ":" + time.getFullYear());
}