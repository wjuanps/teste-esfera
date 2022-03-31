# Teste Esfera

### Clone the repo in your terminal by clicking the green clone or download button at the top right and copyin the url

```bash
$ git clone https://github.com/wjuanps/teste-esfera.git
```

## System requirements

This project was tested in

* Linux Mint 20.3 Cinnamon

## Database

This project was tested in [MysQL](https://dev.mysql.com/downloads/mysql/) Version Ver 8.0.28

# Installation

### Install the package through [Composer](https://getcomposer.org/), inside the project package.

```bash
$ composer install
```

### Copy .env.exemple to .env and configure the database


```bash
$ cp .env.exemple .env
```

## Generate project key


```bash
$ php artisan key:generate
```

### After configuring the database, run

```bash
$ php artisan migrate --seed
```

## Usage

### In the project directory, run the following command to start the application

```bash
$ php artisan serve
```

### The project will run on the default port 8000

## License
[MIT](https://choosealicense.com/licenses/mit/)
