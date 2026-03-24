# Equipments Gest Assets

Yii2 web application for managing equipment, repairs, employees, companies, locations, fixed assets, and related support tables.

This project is based on the **Yii2 Basic App** template and has been customized into an internal backoffice system with RBAC, modularized domains, AJAX CRUD flows, image management, audit support, and Codeception tests.

## Features

- Equipment management
- Equipment families and subfamilies
- Equipment states
- Equipment movements and movement types
- Equipment repair management
- Employee and employee type management
- Company management
- Location management
- Fixed asset (`Imobilizado`) management
- Image and category management
- RBAC permissions and assignments
- Audit support
- Seed/demo data migrations
- AJAX CRUD helpers
- PDF/report-related views

## Tech stack

- PHP >= 7.4
- Yii2 ~2.0.45
- MySQL
- Bootstrap 4 / 5
- AdminLTE 3
- mdmsoft/yii2-admin
- Kartik Yii2 widgets
- bedezign/yii2-audit
- petersonsilvadejesus/yii2-image-manager
- Codeception

## Online Demo

Demo site for testing, it resets every hour.

[Demo GestAssets](https://Demo-GestAssets.appa8.com)

User: demoadmin<br>
Pass: password

## Installation

### 1. Install dependencies

## Docker

This project includes a simple Docker setup:

```bash
docker-compose up -d
```

Default User: demoadmin Pass: password

It will start a full demo on docker

The "entrypoint.sh" files will clean e restart DataBase every time it restarts be carefull.

The included container uses:

- Image: `yiisoftware/yii2-php:7.4-apache`
- Port mapping: `8000:80`

After startup, open:

```text
http://127.0.0.1:8000
```

## Authentication and authorization

This project uses Yii2 RBAC with `mdmsoft/yii2-admin`.

Configured admin module:

- module id: `admin`
- assignment controller enabled
- DB-based auth manager in console config

## Author

Source files include author references to:

**Ricardo Grangeia Dias**  
Site: `https://ricardo.grangeia.pt`
