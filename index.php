<!DOCTYPE html>
<html>

<head>
    <title>Малик Т - Обменный пункт</title>
    <meta charset="utf-8">
    <meta content="width=device-width,initial-scale=1" name="viewport">

    <link rel="icon" href="favicon.ico">
    <link rel="stylesheet" href="css/global.css">

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
                                width="100%" height="50"></a>
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
                        <div class="header__info">Данные за:&nbsp;
                            <span><?=$currency->update;?></span></div>
                    </div>
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
                            <div class="calc__wrapper">
                                <div class="calc__tabs"><button class="calc-tabs__item" disabled="">Валютный
                                        калькулятор</button></div>
                                <form action="#" class="calc__body">
                                    <div class="calc__item">
                                        <p class="calc__text">Покупка</p>
                                        <div><span class="currency">₸</span> <input class="calc__input" value="0"
                                                min="0" type="number">
                                            <select class="calc__select">
                                                <option value="KZT" selected>KZT </option>
                                                <option value="USD">USD </option>
                                                <option value="EUR">EUR </option>
                                                <option value="RUB">RUB </option>
                                            </select></div>
                                    </div>
                                    <div class="calc__item calc__item_buy">
                                        <p class="calc__text">Продажа</p>
                                        <div><span class="currency_two">$</span> <input
                                                class="calc__input calc__input_two" value="0" min="0" type="number">
                                            <select class="calc__select_two">
                                                <option value="KZT">KZT </option>
                                                <option value="USD" selected>USD </option>
                                                <option value="EUR">EUR </option>
                                                <option value="RUB">RUB </option>
                                            </select></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="header__bot">
                    <div class="container header__bot-container">
                        <div class="header__tabs"><a href="#" class="tab__item tab__item_active">Курс НБРК</a> </div>
                        <div class="header__info">Данные за:&nbsp;
                            <span><?=$currency->update;?></span></div>
                    </div>
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
                        <h4 class="contacts__heading">Контакты</h4>
                        <div class="contacts__wrapper">
                            <div class="contacts__info">
                                <div class="contacts__item">
                                    <p class="contacts__bold">Режим работы</p>
                                    <address>Пн - Вс — с 09:00 до 19:30</address>
                                </div>
                                <div class="contacts__item">
                                    <p class="contacts__bold">Адрес обменника</p>
                                    <address>проспект Абилкайыр-хана, 64/1</address>
                                    <address>проспект Абилкайыр-хана, 70</address>
                                </div>
                                <div class="contacts__item">
                                    <p class="contacts__bold">Телефоны для связи</p>
                                    <p>
                                        <a href="tel:77014047950">
                                            <address class="contacts__social contacts__social_tel">+7 (701) 404 79 50
                                            </address>
                                        </a>
                                    </p>
                                    <p>
                                        <a href="https://wa.me/+77014047950" target="_blank"
                                            class="contacts__social contacts__social_whatsapp">WhatsApp</a>
                                    </p>
                                    <!-- <p>
                                        <a href="#" class="contacts__social contacts__social_notify sp_notify_prompt">Включить уведомления</a>
                                    </p> -->
                                </div>
                            </div>
                            <div class="contacts__map">
                                <div class="map__wrapper">
                                    <a class="dg-widget-link"
                                        href="http://2gis.kz/aktobe/firm/70000001067756078/center/57.166594,50.287706/zoom/16?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=bigMap">Посмотреть
                                        на карте Актобе</a>
                                    <div class="dg-widget-link"><a
                                            href="http://2gis.kz/aktobe/center/57.166594,50.287706/zoom/16/routeTab/rsType/bus/to/57.166594,50.287706╎Малик Т, пункт обмена валют?utm_medium=widget-source&utm_campaign=firmsonmap&utm_source=route">Найти
                                            проезд до Малик Т, пункт обмена валют</a></div>
                                    <script charset="utf-8" src="https://widgets.2gis.com/js/DGWidgetLoader.js">
                                    </script>
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
                                    </script><noscript style="color:#c00;font-size:16px;font-weight:bold;">Виджет карты
                                        использует JavaScript. Включите его в настройках вашего браузера.</noscript>
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
