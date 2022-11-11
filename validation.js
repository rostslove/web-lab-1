function validate() {
    var valX = validateX();
    var valY = validateY();
    return valX && valY;
}

function validateY() {
    var y = document.getElementById('Y').value;
    if (!isNumeric(y)) {
        document.getElementById('errorY').textContent = "Введите число!";
        return false;
    }
    if (!(parseFloat(y) >= -5 && parseFloat(y) <= 3)) {
        document.getElementById('errorY').textContent = "Число должно лежать в диапазоне от -5 до 3!";
        return false;
    }
    document.getElementById('errorY').textContent = "";
    return true;
    /*if (isNumeric(x) && parseFloat(x) >= -5 && parseFloat(x) <= 3) {
        console.log("x is true");
        return true;
    } else {
        console.log("x is false");
        document.getElementById('errorX').textContent = "Некорректное значение";
        return false;
    }*/
}

function validateX() {
    var checkList = document.querySelectorAll('input[type="checkbox"]:checked');
    if (checkList.length == 0) {
        document.getElementById('errorX').textContent = "Выберите 1 значение!";
        return false;
    }
    if (checkList.length > 1) {
        document.getElementById('errorX').textContent = "Выберите только 1 значение!";
        return false;
    }
    document.getElementById('errorX').textContent = "";
    return true;
    /*if (checkList.length == 1) {
        return true;
    } else {
        document.getElementById('errorY').textContent = "Выберите только 1 значение!";
        return false;
    }*/
}
function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}