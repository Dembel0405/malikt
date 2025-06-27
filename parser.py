print("Скрипт запущен")

try:
    # Весь код скрипта
    import datetime
    from selenium import webdriver
    from selenium.webdriver.common.by import By
    import requests
    import xml.etree.ElementTree as ET
    import json
    import os
    print("Импорты прошли успешно")

    url = 'https://ifin.kz/exchanger/malik-t/branch/33352'
    from selenium.webdriver.chrome.service import Service
    chrome_driver_path = '/usr/local/bin/geckodriver'

    service = Service(executable_path=chrome_driver_path)
    options = webdriver.FirefoxOptions()
    options.add_argument('--headless')
    options.add_argument('--no-sandbox')
    print("Перед запуском браузера")

    driver = webdriver.Firefox(service=service, options=options)
    print("Браузер запущен")

    driver.get(url)

    currency_rate_big_elements = driver.find_elements(By.CLASS_NAME, 'currency-rate-big')
    currency = []

    for element in currency_rate_big_elements:
        currency_value = element.text
        currency.append(currency_value)
    driver.quit()

    print("Валюты получены:", currency)

    current_time = datetime.datetime.now()
    formatted_time = current_time.strftime("%Y-%m-%d %H:%M:%S")

    url = "http://www.nationalbank.kz/rss/rates_all.xml"
    response = requests.get(url)

    if response.status_code != 200:
        print("nbrk upal")
        exit(1)
    else:
        root = ET.fromstring(response.content)
        usd = eur = rub = None

        for item in root.findall("./channel/item"):
            title = item.find("title").text
            description = item.find("description").text

            if title == "USD":
                usd = description
            elif title == "EUR":
                eur = description
            elif title == "RUB":
                rub = description

    if len(currency) < 6:
        print("Ошибка: недостаточно данных:", currency)
        exit(1)

    a = {
        "update": formatted_time,
        "usd": {
            "buy": currency[0],
            "sell": currency[1],
            "nbrk": usd
        },
        "eur": {
            "buy": currency[2],
            "sell": currency[3],
            "nbrk": eur
        },
        "rub": {
            "buy": currency[4],
            "sell": currency[5],
            "nbrk": rub
        },
    }

    file_path = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'currency.json')
    with open(file_path, 'w', encoding='utf-8') as json_file:
        json.dump(a, json_file, ensure_ascii=False, indent=4)

    print("Готово, файл сохранён:", file_path)

except Exception as e:
    print("Ошибка во время выполнения скрипта:", e)
