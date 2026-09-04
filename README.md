# Redirect Resolver API

HTTP redirect resolver for Render. It follows server-side HTTP redirects without JavaScript or a browser.

## Endpoint

`/?url=https://example.com/path`

## Response

```json
{
  "success": true,
  "original_url": "https://example.com/path",
  "final_url": "https://example.com/final",
  "http_code": 200
}
```

Deploy this repository to Render as a Docker Web Service.
