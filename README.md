# CashAfrica Irrigation System API Documentation

This document provides comprehensive details about the Irrigation System RESTful API built with Laravel 8+.

## Authentication

All API endpoints except for registration and login require authentication using Laravel Sanctum. Authentication is token-based.

### Registration

**Endpoint:** `POST /api/v1/auth/register`

**Request Body:**
```json
{
  "name": "samson segun",
  "email": "samody2006@gmail.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

**Success Response:**
```json
{
    "success": true,
    "message": "User registered successfully",
    "data": {
        "user": {
            "name": "samson segun",
            "email": "samody2006@gmail.com",
            "updated_at": "2025-04-30T14:46:22.000000Z",
            "created_at": "2025-04-30T14:46:22.000000Z",
            "id": 1
        },
        "access_token": "1|FMFLpBJBp2pYg3XjB7Q7r9L4192gnWAgKpxTQaq2",
        "token_type": "Bearer"
    }
}
```

### Login

**Endpoint:** `POST /api/v1/auth/login`

**Request Body:**
```json
{
  "email": "samody2006@gmail.com",
  "password": "password123"
}
```

**Success Response:**
```json
{
    "success": true,
    "message": "Login successful",
    "data": {
        "user": {
            "id": 1,
            "name": "samson segun",
            "email": "samody2006@gmail.com",
            "email_verified_at": null,
            "created_at": "2025-04-30T14:46:22.000000Z",
            "updated_at": "2025-04-30T14:46:22.000000Z"
        },
        "access_token": "2|pBDsviDInoj7F89fylZ24YFhMTF8dub4UWNZePHL",
        "token_type": "Bearer"
    }
}
```

### Logout

**Endpoint:** `POST /api/v1/auth/logout`  
**Authentication:** Required

**Success Response:**
```json
{
  "success": true,
  "message": "Logged out successfully"
}
```

### Get Current User

**Endpoint:** `GET /api/v1/auth/user`  
**Authentication:** Required

**Success Response:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "samson segun",
        "email": "samody2006@gmail.com",
        "email_verified_at": null,
        "created_at": "2025-04-30T14:46:22.000000Z",
        "updated_at": "2025-04-30T14:46:22.000000Z"
    }
}
```

## Zone Management

Zones represent different areas in the irrigation system.

### List All Zones

**Endpoint:** `GET /api/v1/zones`  
**Authentication:** Required

**Success Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Akobo Farm",
            "area": "East",
            "is_watering": 0,
            "created_at": "2025-04-30T17:39:12.000000Z",
            "updated_at": "2025-04-30T17:39:12.000000Z"
        },
        {
            "id": 2,
            "name": "Owo Farm",
            "area": "south",
            "is_watering": 0,
            "created_at": "2025-04-30T17:43:08.000000Z",
            "updated_at": "2025-04-30T17:43:08.000000Z"
        },
        {
            "id": 3,
            "name": "Ogun Farm",
            "area": "south",
            "is_watering": 0,
            "created_at": "2025-04-30T17:43:23.000000Z",
            "updated_at": "2025-04-30T17:43:23.000000Z"
        }
    ]
}
```

### Create a Zone

**Endpoint:** `POST /api/v1/zones`  
**Authentication:** Required

**Request Body:**
```json
{
  "name": "Akobo Farm",
  "area": "East"
}
```

**Success Response:**
```json
{
    "success": true,
    "message": "Zone created successfully",
    "data": {
        "name": "Akobo Farm",
        "area": "East",
        "updated_at": "2025-04-30T17:39:12.000000Z",
        "created_at": "2025-04-30T17:39:12.000000Z",
        "id": 1
    }
}
```

### Get Zone Details

**Endpoint:** `GET /api/v1/zones/{zone}`  
**Authentication:** Required

**Success Response:**
```json
{
    "success": true,
    "data": {
        "id": 2,
        "name": "Iwo Road Farm",
        "area": "south",
        "is_watering": 0,
        "created_at": "2025-04-30T17:43:08.000000Z",
        "updated_at": "2025-04-30T17:47:23.000000Z"
    }
}
```

### Update a Zone

**Endpoint:** `PUT /api/v1/zones/{zone}`  
**Authentication:** Required

**Request Body:**
```json
{
  "name": "Iwo Road Farm",
  "area": "south"
}
```

**Success Response:**
```json
{
    "success": true,
    "message": "Zone updated successfully",
    "data": {
        "id": 2,
        "name": "Iwo Road Farm",
        "area": "south",
        "is_watering": 0,
        "created_at": "2025-04-30T17:43:08.000000Z",
        "updated_at": "2025-04-30T17:47:23.000000Z"
    }
}
```

### Delete a Zone

**Endpoint:** `DELETE /api/v1/zones/{zone}`  
**Authentication:** Required

**Success Response:**
```json
{
  "success": true,
  "message": "Zone deleted successfully"
}
```

## Schedule Management

Schedules control when zones are watered.

### List Zone Schedules

**Endpoint:** `GET /api/v1/zones/{zone}/schedules`  
**Authentication:** Required

**Success Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "zone_id": 2,
            "start_time": "12:30:00",
            "duration": "45",
            "days_of_week": [
                "Tuesday",
                "Thursday",
                "Saturday"
            ],
            "created_at": "2025-05-01T07:15:44.000000Z",
            "updated_at": "2025-05-01T07:15:44.000000Z"
        },
        {
            "id": 2,
            "zone_id": 2,
            "start_time": "12:30:00",
            "duration": "45",
            "days_of_week": [
                "Tuesday",
                "Thursday",
                "Saturday"
            ],
            "created_at": "2025-05-01T07:23:28.000000Z",
            "updated_at": "2025-05-01T07:23:28.000000Z"
        }
    ]
}
```

### Create a Schedule

**Endpoint:** `POST /api/v1/zones/{zone}/schedules`  
**Authentication:** Required

**Request Body:**
```json
{
  "start_time": "12:30",
  "duration": "45",
  "days_of_week": ["Tuesday", "Thursday", "Saturday"]
}
```

**Success Response:**
```json
{
    "success": true,
    "message": "Schedule created successfully",
    "data": {
        "start_time": "12:30",
        "duration": "45",
        "days_of_week": [
            "Tuesday",
            "Thursday",
            "Saturday"
        ],
        "zone_id": 2,
        "updated_at": "2025-05-01T07:23:28.000000Z",
        "created_at": "2025-05-01T07:23:28.000000Z",
        "id": 2
    }
}
```

**Note:** An email notification will be sent to the admin (admin@cashcardng.com) when a schedule is created.

### Get Schedule Details

**Endpoint:** `GET /api/v1/zones/{zone}/schedules/{schedule}`  
**Authentication:** Required

**Success Response:**
```json
{
    "success": true,
    "data": {
        "id": 2,
        "zone_id": 2,
        "start_time": "12:30:00",
        "duration": "45",
        "days_of_week": [
            "Tuesday",
            "Thursday",
            "Saturday"
        ],
        "created_at": "2025-05-01T07:23:28.000000Z",
        "updated_at": "2025-05-01T07:23:28.000000Z"
    }
}
```

### Update a Schedule

**Endpoint:** `PUT /api/v1/zones/{zone_id}/schedules/{schedule_id}`  
**Authentication:** Required

**Request Body:**
```json
{
  "start_time": "07:15",
  "duration": "25",
  "days_of_week": ["Monday", "Wednesday", "Friday", "Sunday"]
}
```

**Success Response:**
```json
{
    "success": true,
    "message": "Schedule updated successfully",
    "data": {
        "id": 2,
        "zone_id": 2,
        "start_time": "07:15",
        "duration": "25",
        "days_of_week": [
            "Monday",
            "Wednesday",
            "Friday",
            "Sunday"
        ],
        "created_at": "2025-05-01T07:23:28.000000Z",
        "updated_at": "2025-05-01T07:29:55.000000Z"
    }
}
```

**Note:** An email notification will be sent to the admin (admin@cashcardng.com) when a schedule is updated.

### Delete a Schedule

**Endpoint:** `DELETE /api/v1/zones/{zone}/schedules/{schedule}`  
**Authentication:** Required

**Success Response:**
```json
{
    "success": true,
    "message": "Schedule deleted successfully"
}
```

## Watering Control

Manage the watering status of zones.

### Start Watering a Zone

**Endpoint:** `POST /api/v1/zones/{zone}/start-watering`  
**Authentication:** Required

**Success Response:**
```json
{
  "success": true,
  "message": "Watering started successfully"
}
```

**Error Response (if already watering):**
```json
{
  "success": false,
  "message": "Zone is already being watered"
}
```

### Stop Watering a Zone

**Endpoint:** `POST /api/v1/zones/{zone}/stop-watering`  
**Authentication:** Required

**Success Response:**
```json
{
  "success": true,
  "message": "Watering stopped successfully"
}
```

**Error Response (if not currently watering):**
```json
{
  "success": false,
  "message": "Zone is not being watered"
}
```

### Get Zone Watering Status

**Endpoint:** `GET /api/v1/zones/{zone}/watering-status`  
**Authentication:** Required

**Success Response:**
```json
{
    "success": true,
    "data": {
        "zone_id": 2,
        "name": "Iwo Road Farm",
        "is_watering": false
    }
}
```

## Error Responses

The API will return appropriate HTTP status codes for different types of errors:

- `400 Bad Request` - Invalid input data
- `401 Unauthorized` - Authentication required or invalid credentials
- `403 Forbidden` - Not authorized to perform the action
- `404 Not Found` - Resource not found
- `422 Unprocessable Entity` - Validation errors
- `500 Internal Server Error` - Server-side error

### Validation Error Example:

```json
{
  "message": "The given data was invalid.",
  "errors": {
    "name": [
      "The name field is required."
    ],
    "area": [
      "The area field is required."
    ]
  }
}
```

## Setting Up Authentication Headers

For endpoints requiring authentication, include the token in the Authorization header:

```
Authorization: Bearer 1|AbCdEfGhIjKlMnOpQrStUvWxYz123456
```

## Postman Collection

To test the API, you can import the following endpoints into Postman:

1. `POST /api/v1/auth/register ` - Register a new user
2. `POST /api/v1/auth/login` - Login and get token
3. `POST /api/v1/auth/logout` - Logout (invalidate token)
4. `GET /api/v1/auth/user` - Get current user info
5. `GET /api/v1/zones` - List all zones
6. `POST /api/v1/zones` - Create a new zone
7. `GET /api/v1/zones/{zone}` - Get zone details
8. `PUT /api/v1/zones/{zone}` - Update a zone
9. `DELETE /api/v1/zones/{zone}` - Delete a zone
10. `GET /api/v1/zones/{zone}/schedules` - List zone schedules
11. `POST /api/v1/zones/{zone}/schedules` - Create a schedule
12. `GET /api/v1/zones/{zone}/schedules/{schedule}` - Get schedule details
13. `PUT /api/v1/zones/{zone}/schedules/{schedule}` - Update a schedule
14. `DELETE /api/v1/zones/{zone}/schedules/{schedule}` - Delete a schedule
15. `POST /api/v1/zones/{zone}/start-watering` - Start zone watering
16. `POST /api/v1/zones/{zone}/stop-watering` - Stop zone watering
17. `GET /api/v1/zones/{zone}/watering-status` - Check zone watering status
