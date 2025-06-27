import datetime
from selenium import webdriver
from selenium.webdriver.common.by import By
import requests
import xml.etree.ElementTree as ET
import json
from selenium.webdriver.chrome.service import Service




chrome_driver_path = '/usr/local/bin/geckodriver'

service = Service(executable_path=chrome_driver_path)
options = webdriver.FirefoxOptions()
options.add_argument('--headless')  # Запуск Firefox в headless-режиме
options.add_argument('--no-sandbox')  # Не используйте sandbox на сервере
driver = webdriver.Firefox(service=service, options=options)
url = "https://drive04.kz/"
driver.get(url)
print(driver.find_elements(By.CLASS_NAME, 'root'))

driver.quit()
