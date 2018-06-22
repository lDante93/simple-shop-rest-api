# Register

Used to collect a Token for a registered User.

**URL** : `/api/user/register/`

**Method** : `POST`

**Auth required** : NO

**Data constraints**

```json
{
    "name": "[string]",
    "email": "[unique email address]",
    "password": "[password in plain text]",
    "password_confirmation": "[same as the password]"
}
```

**Data example**

```json
{
    "name": "user",
    "email": "user@example.com",
    "password": "abcd1234",
    "password_confirmation": "abcd1234"
}
```

## Success Response

**Code** : `200 OK`

**Content example**

```json
{
    "user": {
        "id": 2,
        "name": "user",
        "email": "user@example.com",
        "updated_at": "Y-m-d H:i:s",
        "created_at": "Y-m-d H:i:s"        
    }
}
```

# Login

Used to collect a Token for a registered User.

**URL** : `/api/user/login/`

**Method** : `POST`

**Auth required** : NO

**Data constraints**

```json
{
    "username": "[valid email address]",
    "password": "[password in plain text]"
}
```

**Data example**

```json
{
    "username": "user@example.com",
    "password": "abcd1234"
}
```

## Success Response

**Code** : `200 OK`

**Content example**

```json
{
    "response": "success",
    "result": {
        "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC8xMjcuMC4wLjE6ODAwMlwvYXBpXC91c2VyXC9sb2dpbiIsImlhdCI6MTUyOTY2OTA1OCwiZXhwIjoxNTI5NjcyNjU4LCJuYmYiOjE1Mjk2NjkwNTgsImp0aSI6IkFtcm5rZDJ0MVRSVnF3UGwiLCJzdWIiOjIsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEiLCJ1c2VyIjp7ImlkIjoyfX0.d9HaKkMGfh7xbu7tRgV7_zzvGiNUfsGPP1lQEj6sSpI"
    }
}
```