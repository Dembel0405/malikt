const puppeteer = require('puppeteer');
const fs = require('fs');
const axios = require('axios');
const xml2js = require('xml2js');
const path = require('path');

async function fetchDataAndSave() {
    try {
      const browser = await puppeteer.launch({
    headless: true,
    args: [
        '--no-sandbox',
        '--disable-setuid-sandbox',
        '--ignore-certificate-errors'
    ]
});




        const page = await browser.newPage();

        const url = 'https://ifin.kz/exchanger/malik-t/branch/33352';
        await page.goto(url, { waitUntil: 'networkidle2', timeout: 0 });

        const currencyRateBigElements = await page.$$('.currency-rate-big');
        const currency = [];
        for (const element of currencyRateBigElements) {
            const currencyValue = await element.evaluate(el => el.textContent.trim());
            currency.push(currencyValue);
        }

        await browser.close();

        const current_time = new Date();
        const date = current_time.toLocaleDateString("ru-RU");
        const time = current_time.toLocaleTimeString("ru-RU");
        const formatted_time = `${date} ${time}`;

        const nbrkUrl = 'http://www.nationalbank.kz/rss/rates_all.xml';
        const nbrkResponse = await axios.get(nbrkUrl);
        const parser = new xml2js.Parser();
        const parsedData = await parser.parseStringPromise(nbrkResponse.data);

        let usd, eur, rub;
        const items = parsedData.rss.channel[0].item;
        for (const item of items) {
            const title = item.title[0];
            const description = item.description[0];

            if (title === 'USD') usd = description;
            else if (title === 'EUR') eur = description;
            else if (title === 'RUB') rub = description;
        }

        const data = {
            update: formatted_time,
            usd: {
                buy: currency[0] || '',
                sell: currency[1] || '',
                nbrk: usd || '',
            },
            eur: {
                buy: currency[2] || '',
                sell: currency[3] || '',
                nbrk: eur || '',
            },
            rub: {
                buy: currency[4] || '',
                sell: currency[5] || '',
                nbrk: rub || '',
            },
        };

        const outputPath = path.join(__dirname, 'currency.json');
        fs.writeFileSync(outputPath, JSON.stringify(data, null, 4), 'utf-8');
        console.log('✅ Курсы успешно обновлены:', formatted_time);
    } catch (error) {
        console.error('❌ Ошибка во время парсинга:', error.message);
        process.exit(1);
    }
}

// Запуск
fetchDataAndSave();
