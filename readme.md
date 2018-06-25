# Register

Used to register an user's account.

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

**Code** : `201 Created`

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

# Logout

Used to expire a Token.

**URL** : `/api/user/logout/`

**Method** : `GET`

**Auth required** : YES


## Success Response

**Code** : `200 OK`

**Content example**

```json
{
    "response": "success",
    "result" : "logged out"
}
```

# Add calculations

Used to expire a Token.

**URL** : `/api/calculation/`

**Method** : `POST`

**Auth required** : YES

**Data constraints**

```json
{
	"cashbox_a": "[required][integer][initial amount of money in cashbox]",
	"income": {
		"takings" : "[required][integer][daily takings]",
		"reservations": "[optional][integer]",
		"others" : "[optional][integer]"
	},
	"costs" : { 
		"shopping" : "[optional][integer]",
		"salaries": { 
			"[optional[string][worker id]": "[integer]"
		},
		"others": "[optional[integer]"
	}
}
```

**Data example**

```json
{
	"cashbox_a": 22280,
	"income": {
		"takings" : 94050,
		"reservations": 333,
		"others" : 0
	},
	"costs" : {
		"shopping" : 100,
		"salaries": {
			"1": 10000
		},
		"others": 32
	}
}
```

## Success Response

**Code** : `200 OK`

**Content example**

```json
{
    "response": "succes",
    "message": {
        "PLN_raw": 106531,
        "PLN": "1,065.31"
    }
}
```

# Calculation get

Used to get user's calculations.

**URL** : `/api/calculation/`

**Method** : `GET`

**Auth required** : YES


## Success Response

**Code** : `200 OK`

**Content example**

```json
    {
        "id": 1,
        "user_id": "2",
        "cashbox_a": 22280,
        "takings": 94050,
        "reservations": 333,
        "income_others": 0,
        "income_sum": 94383,
        "shopping": 100,
        "salaries": 10000,
        "costs_others": 32,
        "costs_sum": 10132,
        "cashbox": 106531,
        "day_of_the_week": "Monday",
        "created_at": "Y-m-d H:i:s",
        "updated_at": "Y-m-d H:i:s"
    }
```

# Calculation get all

Used to get all calculations.

**URL** : `/api/calculation/all`

**Method** : `GET`

**Auth required** : YES


## Success Response

**Code** : `200 OK`

**Content example**

```json
    {
        "id": 1,
        "user_id": "1",
        "cashbox_a": 2280,
        "takings": 94050,
        "reservations": 0,
        "income_others": 0,
        "income_sum": 94050,
        "shopping": 0,
        "salaries": 6000,
        "costs_others": 0,
        "costs_sum": 6000,
        "cashbox": 90330,
        "day_of_the_week": "Thursday",
        "created_at": "Y-m-d H:i:s",
        "updated_at": "Y-m-d H:i:s"
    },
    {
        "id": 2,
        "user_id": "2",
        "cashbox_a": 133300,
        "takings": 73421,
        "reservations": 0,
        "income_others": 0,
        "income_sum": 73421,
        "shopping": 1000,
        "salaries": 35000,
        "costs_others": 0,
        "costs_sum": 36000,
        "cashbox": 170721,
        "day_of_the_week": "Monday",
        "created_at": "Y-m-d H:i:s",
        "updated_at": "Y-m-d H:i:s"
    },
```

# Calculation get since date

Used to get all calculations since the given date in timestamp, to the present day.

**URL** : `/api/calculation/[timestamp]`

**Example URL** : `/api/calculation/1514764800`

**Method** : `GET`

**Auth required** : YES


# Calculation get between dates

Used to get all calculations between the given dates in timestamps.

**URL** : `/api/calculation/[timestamp]/[timestamp]`

**Example URL** : `/api/calculation/1529539200/1529625600`

**Method** : `GET`

**Auth required** : YES

```