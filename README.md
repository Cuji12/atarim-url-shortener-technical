# Atarim URL Shortener Technical

---

## Prerequisites
You'll need Docker installed on your machine to run this project, you can find installation
instructions here: https://docs.docker.com/get-started/get-docker/.

## Installation
- `git clone git@github.com:Cuji12/atarim-url-shortener-technical.git`
- `cd atarim-url-shortener-technical`
- `cp .env.example .env && cp .env.example .env.testing`
- `Add any random string to the API_TOKEN env variable.`
- `composer install`
- `npm install`
- `sail up -d`
- `sail artisan key:generate`
- `sail artisan migrate`
- `npm run dev`
