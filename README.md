[![Linter](https://github.com/unendingfebruary/zoho-test-task/actions/workflows/check.yml/badge.svg)](https://github.com/unendingfebruary/zoho-test-task/actions/workflows/check.yml)


## Setup:

```
make install
make start
```

## Update `.env` variables:

```
ZOHO_CLIENT_ID=
ZOHO_CLIENT_SECRET=
ZOHO_CLIENT_CODE=
```

## Tokens:

To generate access token `GET /api/generate-token` <br>
To refresh access token `GET /api/refresh-token`

## Modules:

Add contact `POST /api/add-contact` <br>

#### Request body example:

```
{
    "First_Name": "Name",
    "Last_Name": "Surname",
    "Email": "example@gmail.com"
}
```

Add deal `POST /api/add-deal`

#### Request body example:

```
{
    "Deal_Name": "Name",
    "Contact_Name": "User (contact) ID",
}
```

