window.onload = function () {
    // console.log(getCookie("currency"));
    
    let json = JSON.parse(getCookie("currency"));

    let c = {"KZT": "1", "USD":json.usd.sell, "EUR":json.eur.sell, "RUB":json.rub.sell}; // Устанавливаем курс валют
    let cc = {"KZT": "1", "USD":json.usd.buy, "EUR":json.eur.buy, "RUB":json.rub.buy}; // Устанавливаем курс валют

    let currencyIcon = {"KZT": "₸", "USD": "$", "EUR": "€", "RUB": "₽"};

    let val = document.querySelector(".calc__input"); // Получаем элемент ввода данных
    let currency1 = document.querySelector(".calc__select"); // Получаем первый селект
    let currency2 = document.querySelector(".calc__select_two"); // Получаем второй селект
    let result = document.querySelector(".calc__input_two"); // Получаем поле куда будем писать результат
    function summ() { // Делаем функцию
        let z = 0;
        if(currency1.value === currency2.value){ // Если оба значения в селектах равны
            result.value = val.value; // То просто вписываем данные из поля ввода
        } else {
            if(currency1.value != "KZT"){ // Если не равны тенге, то
                z = val.value*c[currency1.value]; // Переводим сумму в тенге
                result.value = Math.ceil((z/c[currency2.value])*100)/100; // Делим на курс и округляем до сотых
            } else { // Если равны
                result.value = Math.ceil((val.value/c[currency2.value])*100)/100; // Умножаем на курс и округляем до сотых
            }
        }
    }
    function summ2() { // Делаем функцию
        let z = 0;
        if(currency2.value === currency1.value){ // Если оба значения в селектах равны
            val.value = result.value; // То просто вписываем данные из поля ввода
        } else {
            if(currency2.value != "KZT"){ // Если не равны тенге, то
                z = result.value*cc[currency2.value]; // Переводим сумму в тенге
                val.value = Math.ceil((z/cc[currency1.value])*100)/100; // Делим на курс и округляем до сотых
            } else { // Если равны
                val.value = Math.ceil((result.value/cc[currency1.value])*100)/100; // Умножаем на курс и округляем до сотых
            }
        }
    }
    val.oninput = function () { // При вводе данных в поле вызываем функцию.
        val.value = Number(val.value).toString();
        summ();
    };
    currency1.onchange = function () { // При смене первого селекта вызываем функцию.
        summ();
        document.querySelector(".currency").innerHTML = currencyIcon[currency1.value];
    };
    result.oninput = function () {
        result.value = Number(result.value).toString();
        summ2();
    }
    currency2.onchange = function () { // При смене второго селекта вызываем функцию.
        summ2();
        document.querySelector(".currency_two").innerHTML = currencyIcon[currency2.value];
    }
}

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return decodeURIComponent(parts.pop().split(";").shift());
  }