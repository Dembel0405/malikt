 window.onload = function () {
            let json = JSON.parse(getCookie("currency"));
            let c = {"KZT": "1", "USD": json.usd.sell, "EUR": json.eur.sell, "RUB": json.rub.sell};
            let cc = {"KZT": "1", "USD": json.usd.buy, "EUR": json.eur.buy, "RUB": json.rub.buy};
            let currencyIcon = {"KZT": "₸", "USD": "$", "EUR": "€", "RUB": "₽"};
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

            function summ() {
                let currency1 = currency1Select.getAttribute("data-value");
                let currency2 = currency2Select.getAttribute("data-value");
                let z = 0;
                if (currency1 === currency2) {
                    result.value = val.value;
                } else {
                    if (currency1 !== "KZT") {
                        z = val.value * c[currency1];
                        result.value = Math.ceil((z / c[currency2]) * 100) / 100;
                    } else {
                        result.value = Math.ceil((val.value / c[currency2]) * 100) / 100;
                    }
                }
            }

            function summ2() {
                let currency1 = currency1Select.getAttribute("data-value");
                let currency2 = currency2Select.getAttribute("data-value");
                let z = 0;
                if (currency2 === currency1) {
                    val.value = result.value;
                } else {
                    if (currency2 !== "KZT") {
                        z = result.value * cc[currency2];
                        val.value = Math.ceil((z / cc[currency1]) * 100) / 100;
                    } else {
                        val.value = Math.ceil((result.value / cc[currency1]) * 100) / 100;
                    }
                }
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
                summ();
            }

            initializeCustomSelect(currency1Select, function () {
                summ();
                let value = currency1Select.getAttribute("data-value");
                document.querySelector(".currency").innerHTML = currencyIcon[value];
            });

            initializeCustomSelect(currency2Select, function () {
                summ2();
                let value = currency2Select.getAttribute("data-value");
                document.querySelector(".currency_two").innerHTML = currencyIcon[value];
            });

            val.oninput = function () {
                val.value = Number(val.value).toString();
                summ();
            };

            result.oninput = function () {
                result.value = Number(result.value).toString();
                summ2();
            };

            swapBtn.addEventListener("click", swapCurrencies);

            function getCookie(name) {
                const value = `; ${document.cookie}`;
                const parts = value.split(`; ${name}=`);
                if (parts.length === 2) return decodeURIComponent(parts.pop().split(";").shift());
            }
        };