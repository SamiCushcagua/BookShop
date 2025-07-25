# BookShop - Laravel Backend Project

## 📚 Overzicht

BookShop is een Laravel-gebaseerde webapplicatie voor het beheren van een boekwinkel. Het systeem biedt functionaliteiten voor gebruikersbeheer, boekbeheer, FAQ-systeem en een contactformulier.

## 🚀 Functies

### Gebruikersbeheer
- Registratie en inloggen van gebruikers
- Admin-panel voor gebruikersbeheer
- Profielbeheer met afbeeldingen
- Rolgebaseerde toegang (admin/gebruiker)

### Boekbeheer
- CRUD-operaties voor boeken
- Afbeelding upload voor boeken
- Categorieën en beschrijvingen
- Zoek- en filterfunctionaliteiten

### FAQ Systeem
- Categorieën en vragen/antwoorden
- Admin-panel voor FAQ-beheer
- Publieke weergave voor bezoekers
- Dynamische toevoeging van nieuwe vragen

### Contactformulier
- Contactformulier voor bezoekers
- Automatische e-mailnotificaties naar admin
- SMTP-configuratie voor Gmail
- Validatie en foutafhandeling

## 🛠️ Technische Vereisten

- PHP 8.1 of hoger
- Laravel 10.x
- MySQL 5.7 of hoger
- Composer
- Node.js en NPM (voor frontend assets)

## 📦 Installatie

### 1. Repository Klonen
```bash
git clone [repository-url]
cd BookShop/Backend-web-projectx
```

### 2. Dependencies Installeren
```bash
composer install
npm install
```

### 3. Environment Configuratie
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Configuratie
Configureer je database-instellingen in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bookshop
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Database Migraties en Seeders
```bash
php artisan migrate:fresh --seed
```

### 6. Storage Link
```bash
php artisan storage:link
```

### 7. Applicatie Starten
```bash
php artisan serve
```

De applicatie is nu beschikbaar op `http://localhost:8000`

## 📧 E-mail Configuratie

Voor het contactformulier, configureer je SMTP-instellingen in `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=jouw-email@gmail.com
MAIL_PASSWORD=jouw-app-wachtwoord
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=jouw-email@gmail.com
MAIL_FROM_NAME="BookShop-CEI"
```

**Belangrijk**: Gebruik een Gmail App-wachtwoord als je 2FA hebt ingeschakeld.

## 👥 Standaard Gebruikers

Na het uitvoeren van de seeders zijn de volgende gebruikers beschikbaar:

### Admin Gebruiker
- **Email**: admin@admin.com
- **Wachtwoord**: admin123*
- **Rol**: Administrator

## 🎨 Frontend

### Kleurenschema
Het project gebruikt een warm kleurenschema:
- **Parchment**: #F2E9D8
- **Sand**: #D7C4A3
- **Olive**: #C2CBA3
- **Sage**: #8B9375
- **Bark**: #6D5C45
- **Olivewood**: #2E2E20

### Responsive Design
- Mobile-first approach
- Flexbox en CSS Grid
- Responsive navigatie
- Touch-vriendelijke interfaces

## 📁 Projectstructuur

```
BookShop/
├── app/
│   ├── Http/Controllers/
│   │   ├── FAQController.php
│   │   ├── ContactController.php
│   │   └── ...
│   ├── Models/
│   │   ├── FAQCategory.php
│   │   ├── FAQQuestion.php
│   │   └── ...
│   └── ...
├── database/
│   ├── migrations/
│   │   ├── create_faq_categories_table.php
│   │   ├── create_faq_questions_table.php
│   │   └── ...
│   └── seeders/
│       ├── FAQSeeder.php
│       ├── DatabaseSeeder.php
│       └── ...
├── resources/
│   └── views/
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       ├── faq/
│       │   ├── index.blade.php
│       │   ├── admin.blade.php
│       │   └── ...
│       ├── emails/
│       │   └── contact.blade.php
│       └── ...
└── public/
    └── css/
        └── style.css
```

## 🔧 Beheer

### Admin Panel Toegang
1. Log in met admin@admin.com
2. Navigeer naar de admin-secties in de navigatie
3. Beheer gebruikers, boeken, FAQ's en meer

### FAQ Beheer
- Ga naar `/faq/admin` (alleen voor admins)
- Voeg nieuwe categorieën toe
- Voeg vragen en antwoorden toe
- Verwijder bestaande items

### Gebruikersbeheer
- Bekijk alle gebruikers in het admin-panel
- Bewerk gebruikersprofielen
- Verwijder gebruikers indien nodig

## 🐛 Troubleshooting

### Veelvoorkomende Problemen

#### Database Migraties
```bash
# Als migraties falen
php artisan migrate:fresh
php artisan config:clear
```



## 👨‍💻 Ontwikkelaar

**Sami A.V.**
- Email: sami.a.v@hotmail.com
- Project: BookShop Backend Web Application

## 📞 Contact

Voor vragen of ondersteuning:
- Email: sami.a.v@hotmail.com
- Project Repository: [GitHub Repository URL]

---
