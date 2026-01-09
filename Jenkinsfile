pipeline {
    agent{
        docker {
            image 'php:8.4-fpm-alpine3.22'
            args '-u root'
        }
    }

    environment {
        DB_CONNECTION="sqlite"
        DB_DATABASE="database/database.sqlite"
    }

    stages {
        stage("Install composer and dependencies") {
            steps {
                sh 'curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer'
                sh 'apk add --no-cache \
                    libpng-dev \
                    libzip-dev \
                    zip \
                    unzip \
                    oniguruma-dev \
                    nodejs \
                    npm \
                    curl'
                sh 'docker-php-ext-install -j$(nproc) mbstring zip exif pcntl gd'
            }
        }
        stage("Copy .env") {
            steps {
                sh 'php -r "file_exists(\'.env\') || copy(\'.env.example\', \'.env\');"'
            }
        }
        stage("Install dependencies") {
            steps {
                sh "composer update"
                sh "composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist"
            }
        }
        stage("Generate key") {
            steps {
                sh "php artisan key:generate"
            }
        }
        stage("Directory Permissions") {
            steps {
                sh "chmod -R 777 storage bootstrap/cache"
            }
        }
        stage("Create Database") {
            steps {
                sh "mkdir -p database"
                sh "php artisan migrate --force"
            }
        }
        stage("Link public storage") {
            steps {
                sh "php artisan storage:link"
            }
        }
        stage("Run tests") {
            steps {
                sh "php artisan test"
            }
        }
    }
}