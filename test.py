from selenium import webdriver
from selenium.webdriver.chrome.service import Service
chrome_driver_path = '/usr/local/bin/geckodriver'
chrome_binary_path = '/usr/bin/chromium-browser'  # Укажите правильный путь

service = Service(executable_path=chrome_driver_path)
options = webdriver.FirefoxOptions()
options.add_argument('--headless')  # Запуск Firefox в headless-режиме
options.add_argument('--no-sandbox')  # Не используйте sandbox на сервере
driver = webdriver.Firefox(service=service, options=options)
