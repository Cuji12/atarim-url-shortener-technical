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

## Making API requests
### Postman
- Create a new collection called Atarim Local
- Set the Auth Type, under Authorization of the collection, as Bearer Token and add your `API_TOKEN` defined in .env
- The port is defined as `80` in docker-compose, if you change that, just update any endpoints accordingly

#### Encode URL Endpoint
- Add a new request called `Encode URL`
- Set method to POST
- Set URL to `http://localhost:80/api/encode_url`
- Add the following to the body as raw JSON
```JSON
{
  "original_url": "https://atarim.io"
}
```
- After hitting Send, you should get a JSON response that looks like the following:
```JSON
{
    "data": {
        "id": 33,
        "original_url": "https://atarim.io",
        "short_url": "ssGwV5"
    }
}
```
#### Decode URL Endpoint
- Add a new request called `Decode URL`
- Set method to GET
- Set URL to `http://localhost:80/api/decode_url/{EXISTING_SHORT_URL}`
  - Where `EXISTING_SHORT_URL` refers to the `short_url` of an existing `Url` record. You can create one either in the UI, or via the API
- After hitting send, you should get a JSON response that looks like the following:
```JSON
{
    "decoded_url": "https://atarim.io"
}
```
### Curl
Update {API_TOKEN} with the value of `API_TOKEN` in your .env
#### Encode URL Endpoint
- In your terminal, run the following:
```bash
curl -X POST http://localhost:80/api/encode_url \
  -H "Authorization: Bearer {API_TOKEN}" \
  -H "Content-Type: application/json" \
  -d '{"original_url": "https://atarim.io"}'
```
- After hitting enter, your should get a JSON response that looks like the following:
```JSON
{"data":{"id":34,"original_url":"https:\/\/atarim.io","short_url":"l2DIgo"}}
```
#### Decode URL Endpoint
- In your terminal, run the following:
  - Where `EXISTING_SHORT_URL` refers to the `short_url` of an existing `Url` record. You can create one either in the UI, or via the API
```bash
curl -X GET http://localhost:80/api/decode_url/{EXISTING_SHORT_URL} \
  -H "Authorization: Bearer {API_TOKEN}"
```
- After hitting enter, your should get a JSON response that looks like the following:
```JSON
{"decoded_url": "https:\/\/atarim.io"}
```

### Potential API Issues
#### 401 Unauthorized
- Check you've set the `API_TOKEN` in .env
- Check you've set the token correctly in your API request tool of choice
- To be sure this isn't just a config caching issue, run `sail artisan config:clear`
