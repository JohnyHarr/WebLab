$('#YES').mouseenter(function() {
    $(this).css('backgroundColor', "darkgreen")
});
$('#NO').mouseenter(function() {
    $(this).css('backgroundColor', "darkred")
});
$('#YES').add('#NO').mouseleave(function() {
    $(this).css('backgroundColor', "rgb(255, 175, 63)")
});

function validateForm() {
    let form = document.forms.form;
    const mapForm = new Map([
        ["ФИО", form.elements.name.value],
        ["Группа", form.elements.group.value],
        ["Вопрос-1", form.elements.question1.value],
        ["Вопрос-2a", document.getElementById("Вопрос-2a").checked ? true : ""],
        ["Вопрос-2b", document.getElementById("Вопрос-2b").checked ? true : ""],
        ["Вопрос-3", form.elements.question3.value]
    ]);

    if (!validateEmptyInputs(mapForm)) return false;
    
    return true;
}

function validateEmptyInputs(mapForm) {
    let result = true;
    let formElement;
    mapForm.forEach((value, key) => {
        if (!result) {
            return false;
        }
        if ((value == "" || value == null) && (key != "Вопрос-2b") && (key != "Вопрос-2a")) {
            formElement = key;
            result = false;
        }
    });
    if (!result) {
        alert("Пожалуйста, заполните поле " + formElement);
        document.getElementById(formElement).focus();
    }
    return result;
}

function hideOK() {
    $('#areYouSure').fadeOut('fast');
}