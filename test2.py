import datetime
from selenium import webdriver
from selenium.webdriver.common.by import By
import requests
import xml.etree.ElementTree as ET
import json

url = 'https://ifin.kz/exchanger/malik-t/branch/33352'

driver = webdriver.Chrome()

driver.get(url)

currency_rate_big_elements = driver.find_elements(By.CLASS_NAME, 'currency-rate-big')
currency = []
for element in currency_rate_big_elements:
    currency_value = element.text

    currency.append(currency_value)
driver.quit()

current_time = datetime.datetime.now()
formatted_time = current_time.strftime("%Y-%m-%d %H:%M:%S")

url = "http://www.nationalbank.kz/rss/rates_all.xml"
response = requests.get(url)

if response.status_code != 200:
    print("nbrk upal")
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

# Сохраняем данные в JSON файл
with open('data.json', 'w', encoding='utf-8') as json_file:
    json.dump(a, json_file, ensure_ascii=False, indent=4)
