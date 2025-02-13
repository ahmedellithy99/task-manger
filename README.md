# Laravel Task Manager API


#### Register a User

**POST** `/api/register`

```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password"
}
```

#### Login User

**POST** `/api/login`

```json
{
  "email": "john@example.com",
  "password": "password"
}
```

*Response:* Returns an API token. Use this token in the Authorization header as `Bearer {token}` for subsequent requests.

#### Logout User

**POST** `/api/logout`


### Task API

| Method | Endpoint          | Description |
| ------ | ----------------- | ----------- |
| GET    | `/api/tasks`      | List tasks  |
| POST   | `/api/tasks`      | Create task |
| PUT    | `/api/tasks/{id}` | Update task |
| DELETE | `/api/tasks/{id}` | Delete task |



