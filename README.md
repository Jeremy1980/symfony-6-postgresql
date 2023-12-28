### Prolog
Repozytorium zawiera, zaimplementowane podstawowe mechanizmy potrzebe na każdej stronie internetowej, do dalszego rozwoju przewidziane. Jest to wersja rozwojowa.
### Konfiguracja /plik .env/
Plik ten musi istnieć w katalogu głównym przed przystąpieniem do opisanych czynności w poniższych punktach.
- MAILER_DSN=native://default
- MAILER_ADDRESS=<your_email_adres>
- MAILER_NAME=<mailbot_name>
- DATABASE_URI=<your_database_connection_information>
### Instalacja
1. composer install
2. npm install
3. npm run dev
### Migracja danych
    php bin/console doctrine:migrations:migrate
### Środowisko testowe    
    PostgreSQL 12.17 
    phpPgAdmin 7.12
    PHP 8.1
### API
- /api/posts &ensp;&ensp; Pobieranie wyszystkich postów z lokalnej bazy danych.
