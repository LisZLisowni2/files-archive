pipeline {
    agent{
        docker {
            image 'liszlisowni/laravel-runner:v1'
            args '-u root'
        }
    }

    environment {
        DB_CONNECTION="sqlite"
        DB_DATABASE="database/database.sqlite"
    }

    stages {
        stage("Notify Github") {
            steps {
                githubNotify status: 'PENDING', description: 'Testing...'
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

    post {
        success {
            githubNotify context: 'Jenkins/Laravel-Tests', status: 'SUCCESS', description: 'Tests passed'
        }
        failure {
            githubNotify context: 'Jenkins/Laravel-Tests', status: 'FAILURE', description: 'Tests failed'
        }
    }
}