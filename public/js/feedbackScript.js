main();

function main() {
    setupOnSubmitValidation();
    setupFormFocusoutValidation();
    setupCalendar();
    setupPopovers();
    setupAreYouSureWindow();
}

function setupOnSubmitValidation() {
    $('#submitButton').click(function() {
        let result = true;
        const formElements = ["Gender", "Age", "BirthDate", "Message", "Mail"];

        formElements.forEach(element => {
            if (!validateEmptyInput($('#'+ element).get(0))) result = false;
        });

        if (!validateName($('#Name').get(0))) result = false;

        if (!validatePhoneNumber($('#PhoneNumber').get(0))) result = false;

        if (result) {
            $('#areYouSure').fadeIn('fast');
            $('#lamps').css('filter', 'blur(8px)').css('-webkit-filter', 'blur(8px)');
            $('#YES').click(function() {
                $('#form').submit();
                $('#areYouSure').fadeOut('fast');
                $('#lamps').css('filter', '').css('-webkit-filter', '');
            });

            $('#NO').click(function() {
                $('#areYouSure').fadeOut('fast');
                $('#lamps').css('filter', '').css('-webkit-filter', '');
            });
        }
    });
}

function hideOK() {
    $('#areYouSure').fadeOut('fast');
}

function setupFormFocusoutValidation() {
    const formElements = ["Gender", "Age", "BirthDate", "Message", "Mail"];

    formElements.forEach(element => {
        $('#'+ element).focusout(function(event) {
            validateEmptyInput(event.target);
        });
    });

    $('#Name').focusout(function(event) {
        validateName(event.target)
    });

    $('#PhoneNumber').focusout(function(event) {
        validatePhoneNumber(event.target)
    });
}

function validateEmptyInput(element) {    
    if (element.value == "" || element.value == null) {
        element.placeholder = "Заполните поле ";
        element.style.backgroundColor = 'darkred';
        return false;
    } else {
        element.placeholder = "...";
        element.style.backgroundColor = 'darkgreen';
        return true;
    }
}

function validateName(element) {
    let result = true;
    let regName = /^[A-Za-z]+ [A-Za-z]+ [A-Za-z]+$/;
    result = regName.test(element.value);
    if (!result) {
        element.value = "";
        element.placeholder = "Некорректные данные";
        element.style.backgroundColor = 'darkred';
    } else {
        element.placeholder = "...";
        element.style.backgroundColor = 'darkgreen';
    }
    return result;
}

function validatePhoneNumber(element) {
    let result = true;
    let regPhoneNumber = /^[\+][7|3][\d]{7,9}[\d]$/;
    result = regPhoneNumber.test(element.value);
    if (!result) {
        element.value = "";
        element.placeholder = "Некорректные данные";
        element.style.backgroundColor = 'darkred';
    } else {
        element.placeholder = "...";
        element.style.backgroundColor = 'darkgreen';
    }
    return result;
}

function didTapResetButton() {
    const formElements = ["Name", "Gender", "Age", "BirthDate", "Message", "Mail", "PhoneNumber"];

    $('#calendar').children().eq(0).hide('fast')
    formElements.forEach(elementName => {
        $('#' + elementName)
            .attr('placeholder', '...')
            .css('backgroundColor', 'rgb(35, 35, 35)');
    });
}

function setupCalendar() {
    let birthDateInput = $('#BirthDate');


    let monthYear = $('<div class="divMonthYear"></div>');

    let monthSelect = $('<select id="monthSelect"></select>');
    let defaultOption = $('<option value="Jan" selected="selected">Jan</option>');
    monthSelect.append(defaultOption);
    const monthNames = ["Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    monthNames.forEach(element => {
        monthSelect.append($('<option value="' + element + '">' + element + '</option>'));
    })
    
    let yearSelect = $('<select id="yearSelect"></select>');
    defaultOption = $('<option value="2004" selected="selected">2004</option>');
    yearSelect.append(defaultOption);
    for (let index = 2003; index >= 1974; index--) {
        yearSelect.append($('<option value="' + index + '">' + index + '</option>'));
    }

    monthYear
        .append(monthSelect)
        .append(yearSelect);


    let dates = $('<div class="divDates"></div>');
    const weekDayNames = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];
    weekDayNames.forEach(element => {
        dates.append($('<div class="divWeekDay">' + element + '</div>'));
    });
    for (let i = 1; i <= 31; i++) {
        let date = $('<div class="divDate" id="' + i + '">' + i + '</div>');
        date
            .mouseenter(function(event) {
                event.target.style.backgroundColor = "gold";
            })
            .mouseleave(function(event) {
                event.target.style.backgroundColor = "rgb(255, 175, 63)";
            })
            .click(function(event) {
                birthDateInput.val(parseInt(event.target.textContent) + "." + monthSelect.val() + "." + yearSelect.val());
                validateEmptyInput(birthDateInput.get(0));
            });
        dates.append(date);
    }


    let calendar = $('<div class="divCalendar"></div>').hide();
    calendar
        .append(monthYear)
        .append(dates);

    let birthDate = $('#calendar');
    birthDate.append(calendar);


    birthDateInput.add(calendar).click(function() {
        if (!(monthSelect.is(":focus") || yearSelect.is(":focus"))) {
            calendar.toggle();
        }
    });

    const month30days = ["Apr", "Jun", "Sep", "Nov"];
    const month31days = ["Jan", "Mar", "May", "Jul", "Aug", "Oct", "Dec"];
    monthSelect.click(function(event) {
        if (month31days.includes(event.target.value)) {
            [29, 30, 31].forEach( element => {
                $('#' + element).show();
            });
         } else if (month30days.includes(event.target.value)){
            [29, 30, 31].forEach( element => {
                $('#' + element).show();
            });
            $('#31').hide();
         } else {
            [29, 30, 31].forEach( element => {
                $('#' + element).hide();
            });
         }
    });
}

function setupPopovers() {
    $('#PhoneNumber')
        .attr('data-toggle', 'popover')
        .attr('data-placement', 'bottom')
        .attr('data-content', 'Номер должен начинаться на +7 или +3 и содержать от 9 до 11 цифр')
        .attr('data-trigger', 'hover')
        .popover({
            delay: 1000
        });
    $('#Name')
        .attr('data-toggle', 'popover')
        .attr('data-placement', 'bottom')
        .attr('data-trigger', 'hover')
        .attr('data-content', 'ФИО должно состоять из трёх слов на английском языке, разделённых пробелом')
        .popover({
            delay: 1000
        });
}

function setupAreYouSureWindow() {
    let areYouSureWindow = $('<div class="areYouSureWindow" id="areYouSure"><p> Вы уверены? </p> <div id="YES"> ДА </div> <div id="NO"> НЕТ </div></div>').hide();
    $('#form').append(areYouSureWindow);

    $('#YES').mouseenter(function() {
        $(this).css('backgroundColor', "darkgreen")
    });
    $('#NO').mouseenter(function() {
        $(this).css('backgroundColor', "darkred")
    });
    $('#YES').add('#NO').mouseleave(function() {
        $(this).css('backgroundColor', "rgb(255, 175, 63)")
    });
}