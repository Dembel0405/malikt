window.onload = function () {
    let json = JSON.parse(getCookie("currency"));
    let c = {"KZT": "1", "USD": json.usd.sell, "EUR": json.eur.sell, "RUB": json.rub.sell};
    let cc = {"KZT": "1", "USD": json.usd.buy, "EUR": json.eur.buy, "RUB": json.rub.buy};
    let currencyIcon = {"KZT": "", "USD": "", "EUR": "", "RUB": ""};
    let flagIcons = {
        "KZT": "../img/kzt.svg",
        "USD": "../img/usd.svg",
        "EUR": "../img/eur.svg",
        "RUB": "../img/rub.svg"
    };

    let val = document.querySelector(".calc__input");
    let result = document.querySelector(".calc__input_two");
    let currency1Select = document.querySelector("#currency1-select");
    let currency2Select = document.querySelector("#currency2-select");
    let swapBtn = document.querySelector(".calc__swap-btn");

    // Set initial currency icons based on default selections
    document.querySelector(".currency").innerHTML = currencyIcon["KZT"];
    document.querySelector(".currency_two").innerHTML = currencyIcon["USD"];

    // Получаем оба input и их соответствующие метки
    let input1 = val;
    let input2 = result;
    let label1 = input1.closest(".calc__item").querySelector(".form-label");
    let label2 = input2.closest(".calc__item").querySelector(".form-label");

    // Функция для управления классом active для обеих меток
    function toggleActiveLabels() {
        let hasValue = input1.value !== "" || input2.value !== "";
        if (hasValue) {
            label1.classList.add("active");
            label2.classList.add("active");
        } else {
            label1.classList.remove("active");
            label2.classList.remove("active");
        }
    }

    // Обработчики для обоих input
    [input1, input2].forEach(input => {
        input.addEventListener("focus", function () {
            label1.classList.add("active");
            label2.classList.add("active");
        });

        input.addEventListener("input", function () {
            toggleActiveLabels();
        });

        input.addEventListener("blur", function () {
            toggleActiveLabels();
        });
    });

    function initializeCustomSelect(selectElement, onChangeCallback) {
        let trigger = selectElement.querySelector(".custom-select__trigger");
        let options = selectElement.querySelector(".custom-select__options");
        let optionElements = selectElement.querySelectorAll(".custom-select__option");
        let arrow = trigger.querySelector(".arrow");

        trigger.addEventListener("click", function () {
            options.classList.toggle("open");
            arrow.classList.toggle("open");
        });

        optionElements.forEach(option => {
            option.addEventListener("click", function () {
                let value = this.getAttribute("data-value");
                trigger.innerHTML = `
                    <img src="${flagIcons[value]}" alt="${value}" class="flag">
                    <span>${value}</span>
                    <img src="../img/ss_arrow.svg" alt="Arrow" class="arrow">
                `;
                options.classList.remove("open");
                arrow.classList.remove("open");
                selectElement.setAttribute("data-value", value);
                onChangeCallback();
            });
        });

        document.addEventListener("click", function (e) {
            if (!selectElement.contains(e.target)) {
                options.classList.remove("open");
                arrow.classList.remove("open");
            }
        });
    }

    function calculateConversion(sourceInput, targetInput, isForward) {
        let currency1 = currency1Select.getAttribute("data-value");
        let currency2 = currency2Select.getAttribute("data-value");
        let inputValue = parseFloat(sourceInput.value);

        if (isNaN(inputValue) || inputValue < 0) {
            targetInput.value = "";
            return;
        }

        let resultValue;
        if (currency1 === currency2) {
            resultValue = inputValue;
        } else {
            if (isForward) {
                // Конвертация из currency1 в currency2 (используем курс продажи для currency1, покупки для currency2)
                let baseValue = currency1 === "KZT" ? inputValue : inputValue * c[currency1];
                resultValue = currency2 === "KZT" ? baseValue : (baseValue / cc[currency2]);
            } else {
                // Конвертация из currency2 в currency1 (используем курс покупки для currency2, продажи для currency1)
                let baseValue = currency2 === "KZT" ? inputValue : inputValue * cc[currency2];
                resultValue = currency1 === "KZT" ? baseValue : (baseValue / c[currency1]);
            }
        }

        targetInput.value = resultValue.toFixed(2);
        toggleActiveLabels();
    }

    function swapCurrencies() {
        let currency1Value = currency1Select.getAttribute("data-value");
        let currency2Value = currency2Select.getAttribute("data-value");
        let input1Value = val.value;
        let input2Value = result.value;

        currency1Select.setAttribute("data-value", currency2Value);
        currency2Select.setAttribute("data-value", currency1Value);

        currency1Select.querySelector(".custom-select__trigger").innerHTML = `
            <img src="${flagIcons[currency2Value]}" alt="${currency2Value}" class="flag">
            <span>${currency2Value}</span>
            <img src="../img/ss_arrow.svg" alt="Arrow" class="arrow">
        `;
        currency2Select.querySelector(".custom-select__trigger").innerHTML = `
            <img src="${flagIcons[currency1Value]}" alt="${currency1Value}" class="flag">
            <span>${currency1Value}</span>
            <img src="../img/ss_arrow.svg" alt="Arrow" class="arrow">
        `;

        document.querySelector(".currency").innerHTML = currencyIcon[currency2Value];
        document.querySelector(".currency_two").innerHTML = currencyIcon[currency1Value];

        val.value = input2Value;
        result.value = input1Value;

        if (val.value !== "") {
            calculateConversion(val, result, true);
        } else if (result.value !== "") {
            calculateConversion(result, val, false);
        } else {
            toggleActiveLabels();
        }
    }

    initializeCustomSelect(currency1Select, function () {
        calculateConversion(val, result, true);
        let value = currency1Select.getAttribute("data-value");
        document.querySelector(".currency").innerHTML = currencyIcon[value];
    });

    initializeCustomSelect(currency2Select, function () {
        calculateConversion(result, val, false);
        let value = currency2Select.getAttribute("data-value");
        document.querySelector(".currency_two").innerHTML = currencyIcon[value];
    });

    val.oninput = function () {
        let value = val.value;
        if (value !== "" && !isNaN(value) && parseFloat(value) >= 0) {
            calculateConversion(val, result, true);
        } else {
            result.value = "";
            toggleActiveLabels();
        }
    };

    result.oninput = function () {
        let value = result.value;
        if (value !== "" && !isNaN(value) && parseFloat(value) >= 0) {
            calculateConversion(result, val, false);
        } else {
            val.value = "";
            toggleActiveLabels();
        }
    };

    swapBtn.addEventListener("click", swapCurrencies);

    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return decodeURIComponent(parts.pop().split(";").shift());
    }
};