<!DOCTYPE html>
<html>

<head>
    <title>Малик Т - Обменный пункт</title>
    <meta charset="utf-8">
    <meta content="width=device-width,initial-scale=1" name="viewport">

    <link rel="icon" href="./img/logo.ico">
    <link rel="stylesheet" href="css/global.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="js/main.js"></script>
</head>

<body>
    <?php
        setcookie("currency", json_encode($currency = json_decode(file_get_contents("currency.json"))), time()+300);
    ?>
    <div id="sapper">
        <main>
            <header class="header">
                <div class="container">
                    <div class="header__top"><a href="/" class="logo"><img src="./img/logo.svg" alt="Малик Т"
                                width="100%" ></a>
                        <nav class="header__nav">
                            <!-- <div class="nav__item"> -->
                                <a href="https://wa.me/+77014047950" target="_blank" class="whatsapp">WhatsApp</a>
                                <!-- <div class="nav__line"></div> -->
                            <!-- </div> -->
                            <!-- <a href="#" class="sp_notify_prompt">Включить уведомления</a> -->
                        </nav>
                    </div>
                </div>
            </header>
            <main>
                <div class="header__bot">
                    <div class="container header__bot-container">
                        <div class="header__tabs"><a href="#" class="tab__item tab__item_active">Курс валют</a> </div>
                </div>
                <section class="hero">
                    <div class="container hero__container">
                        <div class="hero__rates">
                            <div class="rates__item"> <img class="rates__flag" src="./img/usd.svg" alt="Флаг" width="41"
                                    height="41">
                                <div class="rates__top">Доллар США <br> <span class="gray">1 - USD</span></div>
                                <div class="rates__bot">
                                    <div class="rates__buy"><span class="gray buy">Покупка</span> <br>
                                        <p class="rates__price"><?=$currency->usd->buy;?>₸</p>
                                    </div>
                                    <div class="line"></div>
                                    <div class="rates__middle_mobile"><img class="rates__flag_mobile"
                                            src="./img/usd.svg" alt="Флаг" width="41" height="41"> <span
                                            class="gray_mobile">USD</span></div>
                                    <div class="rates__sell"><span class="gray buy">Продажа</span> <br>
                                        <p class="rates__price"><?=$currency->usd->sell;?>₸</p>
                                    </div>
                                </div>
                            </div>
                            <div class="rates__item"> <img class="rates__flag" src="./img/eur.svg" alt="Флаг" width="41"
                                    height="41">
                                <div class="rates__top">Евро <br> <span class="gray">1 - EUR</span></div>
                                <div class="rates__bot">
                                    <div class="rates__buy"><span class="gray buy">Покупка</span> <br>
                                        <p class="rates__price"><?=$currency->eur->buy;?>₸</p>
                                    </div>
                                    <div class="line"></div>
                                    <div class="rates__middle_mobile"><img class="rates__flag_mobile"
                                            src="./img/eur.svg" alt="Флаг" width="41" height="41"> <span
                                            class="gray_mobile">EUR</span></div>
                                    <div class="rates__sell"><span class="gray buy">Продажа</span> <br>
                                        <p class="rates__price"><?=$currency->eur->sell;?>₸</p>
                                    </div>
                                </div>
                            </div>
                            <div class="rates__item"> <img class="rates__flag" src="./img/rub.svg" alt="Флаг" width="41"
                                    height="41">
                                <div class="rates__top">Российский рубль <br> <span class="gray">1 - RUB</span></div>
                                <div class="rates__bot">
                                    <div class="rates__buy"><span class="gray buy">Покупка</span> <br>
                                        <p class="rates__price"><?=$currency->rub->buy;?>₸</p>
                                    </div>
                                    <div class="line"></div>
                                    <div class="rates__middle_mobile"><img class="rates__flag_mobile"
                                            src="./img/rub.svg" alt="Флаг" width="41" height="41"> <span
                                            class="gray_mobile">RUB</span></div>
                                    <div class="rates__sell"><span class="gray buy">Продажа</span> <br>
                                        <p class="rates__price"><?=$currency->rub->sell;?>₸</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hero__calc" id="calc">
        <h1 class="calc__title">Калькулятор обмена валюты</h1>
        <div class="calc__wrapper">
            <form action="#" class="calc__body">
                <div class="calc__item">
                    <div>
                        <span class="currency">₸</span>
                        <input class="calc__input" min="0" type="number" id="myInput">
                        <span class="form-label dark:text-white" for="myInput">У меня есть</span>
                        <div class="custom-select" id="currency1-select" data-value="KZT">
                            <div class="custom-select__trigger">
                                <img src="../img/kzt.svg" alt="KZT" class="flag">
                                <span>KZT</span>
                                <img src="../img/ss_arrow.svg" alt="Arrow" class="arrow">
                            </div>
                            <div class="custom-select__options">
                                <div class="custom-select__option" data-value="KZT">
                                    <img src="../img/kzt.svg" alt="KZT"> KZT
                                </div>
                                <div class="custom-select__option" data-value="USD">
                                    <img src="../img/usd.svg" alt="USD"> USD
                                </div>
                                <div class="custom-select__option" data-value="EUR">
                                    <img src="../img/eur.svg" alt="EUR"> EUR
                                </div>
                                <div class="custom-select__option" data-value="RUB">
                                    <img src="../img/rub.svg" alt="RUB"> RUB
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="calc__swap">
                    <button class="calc__swap-btn" type="button">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M21.2594 8.35367L16.2594 13.3537L14.8451 11.9395L18.138 8.64656L2.0337 8.64655V6.64655L18.138 6.64656L14.8451 3.35366L16.2594 1.93945L21.2594 6.93945L21.9665 7.64656L21.2594 8.35367ZM2.7408 17.0608L7.7408 22.0608L9.15501 20.6465L5.81747 17.309H21.9665V15.309H5.90676L9.15501 12.0608L7.7408 10.6465L2.7408 15.6465L2.03369 16.3537L2.7408 17.0608Z" fill="currentColor"/>
</svg>
                    </button>
                </div>
                <div class="calc__item calc__item_buy">
    <div>
        <span class="currency_two">$</span>
        <input class="calc__input calc__input_two" min="0" type="number" id="myInput">
        <span class="form-label dark:text-white" for="myInput">Хочу приобрести</span>
        <div class="custom-select" id="currency2-select" data-value="USD">
            <div class="custom-select__trigger">
                <img src="../img/usd.svg" alt="USD" class="flag">
                <span>USD</span>
                <img src="../img/ss_arrow.svg" alt="Arrow" class="arrow">
            </div>
            <div class="custom-select__options">
                <div class="custom-select__option" data-value="KZT">
                    <img src="../img/kzt.svg" alt="KZT"> KZT
                </div>
                <div class="custom-select__option" data-value="USD">
                    <img src="../img/usd.svg" alt="USD"> USD
                </div>
                <div class="custom-select__option" data-value="EUR">
                    <img src="../img/eur.svg" alt="EUR"> EUR
                </div>
                <div class="custom-select__option" data-value="RUB">
                    <img src="../img/rub.svg" alt="RUB"> RUB
                </div>
            </div>
        </div>
    </div>
</div>
            </form>
        </div>
    </div>
                </section>
                <div class="header__bot">
                    <div class="container header__bot-container">
                        <div class="header__tabs"><a href="#" class="tab__item tab__item_active">Курс НБРК</a> </div>
                </div>

                <section class="hero">
                    <div class="container hero__container">
                        <div class="hero__rates hero__rates_nbrk">
                            <div class="rates__item">
                                <div class="rates__bot">
                                    <div class="rates__middle">
                                        <img class="rates__flag" src="./img/usd.svg" alt="Флаг" width="41" height="41">
                                        <span class="gray">USD</span>
                                    </div>
                                    <div class="rates__middle_mobile"><img class="rates__flag_mobile"
                                            src="./img/usd.svg" alt="Флаг" width="41" height="41"> <span
                                            class="gray_mobile">USD</span></div>
                                    <div class="rates__sell">
                                        <p class="rates__price"><?=$currency->usd->nbrk;?>₸</p>
                                    </div>
                                </div>
                            </div>
                            <div class="rates__item">
                                <div class="rates__bot">
                                    <div class="rates__middle"><img class="rates__flag" src="./img/eur.svg" alt="Флаг"
                                            width="41" height="41"> <span class="gray">EUR</span></div>
                                    <div class="rates__middle_mobile"><img class="rates__flag_mobile"
                                            src="./img/eur.svg" alt="Флаг" width="41" height="41"> <span
                                            class="gray_mobile">EUR</span></div>
                                    <div class="rates__sell"><span class="gray buy"></span>
                                        <p class="rates__price"><?=$currency->eur->nbrk;?>₸</p>
                                    </div>
                                </div>
                            </div>
                            <div class="rates__item">
                                <div class="rates__bot">
                                    <div class="rates__middle"><img class="rates__flag" src="./img/rub.svg" alt="Флаг"
                                            width="41" height="41"> <span class="gray">RUB</span></div>
                                    <div class="rates__middle_mobile"><img class="rates__flag_mobile"
                                            src="./img/rub.svg" alt="Флаг" width="41" height="41"> <span
                                            class="gray_mobile">RUB</span></div>
                                    <div class="rates__sell"><span class="gray buy"></span>
                                        <p class="rates__price"><?=$currency->rub->nbrk;?>₸</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="contacts">
    <div class="container">
        <h4 class="contacts__heading">Контактная информация</h4>
        <div class="contacts__wrapper">
            <div class="contacts__info">
                <div class="contacts__item">
                    <p class="contacts__bold">Часы работы</p>
                    <address class="contacts__social contacnts__graph">Ежедневно с 09:00 до 20:00</address>
                </div>
                <div class="contacts__item">
                    <p class="contacts__bold">Адреса обменных пунктов</p>
                    <address class="contacts__social contacnts__adress">пр. Абилкайыр-хана, 64/1</address>
                    <address class="contacts__social contacnts__adress">пр. Абилкайыр-хана, 70</address>
                </div>
                <div class="contacts__item">
                    <p class="contacts__bold">Контактные телефоны</p>
                    <p>
                        <a href="tel:+77014047950">
                            <address class="contacts__social contacts__social_tel">+7 (701) 404-79-50</address>
                        </a>
                    </p>
                    <p>
                        <a href="https://wa.me/+77014047950" target="_blank" class="contacts__social contacts__social_whatsapp">WhatsApp</a>
                    </p>
                </div>
            </div>
            <div class="contacts__map">
                <div class="map__wrapper">
                    <a class="dg-widget-link" href="http://2gis.kz/aktobe/firm/70000001067756078/center/57.166594,50.287706/zoom/16?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=bigMap">Открыть на карте Актобе</a>
                    <div class="dg-widget-link">
                        <a href="http://2gis.kz/aktobe/center/57.166594,50.287706/zoom/16/routeTab/rsType/bus/to/57.166594,50.287706╎Малик Т, пункт обмена валют?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=route">Проложить маршрут до пункта обмена валют Малик Т</a>
                    </div>
                    <script charset="utf-8" src="https://widgets.2gis.com/js/DGWidgetLoader.js"></script>
                    <script charset="utf-8">
                        new DGWidgetLoader({
                            "width": screen.width <= 960 ? "100%" : 740,
                            "height": 600,
                            "borderColor": "#a3a3a3",
                            "pos": {
                                "lat": 50.287706,
                                "lon": 57.166594,
                                "zoom": 16
                            },
                            "opt": {
                                "city": "aktobe"
                            },
                            "org": [{
                                "id": "70000001067756078"
                            }]
                        });
                    </script>
                    <noscript style="color:#c00;font-size:16px;font-weight:bold;">Для работы виджета карты необходимо включить JavaScript в настройках браузера.</noscript>
                </div>
            </div>
        </div>
    </div>
</section>
            </main>
        </main>
    </div>
</body>

</html>
