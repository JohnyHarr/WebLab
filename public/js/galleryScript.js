let dir = "./assets/galleryImgs/";

let stableGrid = $('#stableGrid');
let dalleGrid = $('#dalleGrid');

let stableImgsNumber = 8;
let dalleImgsNumber = 7;

let stableNames = setupNames("stable-", stableImgsNumber);
let dalleNames = setupNames("dalle-", dalleImgsNumber);
    
setListeners(stableGrid);
setListeners(dalleGrid);

function setupNames(imgNameBase, imgsNumber) {
    let names = [];
    for (let index = 1; index <= imgsNumber; index++) {
        names[index] = imgNameBase + index;
    }
    return names;
}

function setListeners(grid) {
    let div;

    grid.children().click(function(event) {
        grid.click(false);
        div = $('#bigImage');
        if (!div.length) {
            div = $('<div id="bigImage" class="biggerImage"></div>');
            div
                .append($(event.target).clone().css('z-index', '2999'))
                .append('<h3 class="mainForm" style="margin: 0; padding: 0; box-shadow: 0 0 0 max(100vh, 100vw) rgb(35, 35, 35)">' + div.children().attr('title') + '</h3>')
                .click(function() {
                    div.remove();
                    $('[alt="up"]')
                        .replaceWith('<a href="#stable"> <p> Stable Diffusion </p> </a>');
                    $('[alt="down"]')
                        .replaceWith('<a href="#dalle"> <p> DALL·E </p> </a>');
                    grid.click(true);
                });

            $('[href="#stable"]')
                .replaceWith('<img src="./assets/icons/up.png" alt="up">');
            $('[href="#dalle"]')
                .replaceWith('<img src="./assets/icons/down.png" alt="down">');
            $('[alt="up"]').add($('[alt="down"]'))  
                .css('display', 'flex')
                .css('width', '5rem')
                .css('padding', '2rem');
            $('[alt="up"]').click(function() {
                let index = div.children().attr('alt').match(/\d+/);
                index--;
                if (index < 1) index = 1;
                let names;
                if (div.children().attr('alt').includes('stable')) {
                    names = stableNames;
                } else {
                    names = dalleNames;
                }
                div.children('img').fadeOut('fast', function() {
                    let newImage = $('<img src="' + dir + names[index] + ".jpg" + '" alt="' + names[index] + '" title="' + names[index] + '" style="z-index: 2999">').hide();
                    div.children('img').replaceWith(newImage);
                    div.children('h3').replaceWith('<h3 class="mainForm" style="margin: 0; padding: 0; box-shadow: 0 0 0 max(100vh, 100vw) rgb(35, 35, 35)">' + names[index] + '</h3>');
                    div.children('img').fadeIn('slow');
                });
            });
            $('[alt="down"]').click(function() {
                let index = div.children().attr('alt').match(/\d+/);
                index++;
                let names;
                if (div.children().attr('alt').includes('stable')) {
                    names = stableNames;
                    if (index > stableImgsNumber) index = stableImgsNumber;
                } else {
                    names = dalleNames;
                    if (index > dalleImgsNumber) index = dalleImgsNumber;
                }
                div.children('img').fadeOut('fast', function() {
                    let newImage = $('<img src="' + dir + names[index] + ".jpg" + '" alt="' + names[index] + '" title="' + names[index] + '" style="z-index: 2999">').hide();
                    div.children('img').replaceWith(newImage);
                    div.children('h3').replaceWith('<h3 class="mainForm" style="margin: 0; padding: 0; box-shadow: 0 0 0 max(100vh, 100vw) rgb(35, 35, 35)">' + names[index] + '</h3>');
                    div.children('img').fadeIn('slow');
                });
            });
            grid.append(div);
        }
    });
}