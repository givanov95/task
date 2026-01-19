# Task

## Installation and Requirements

Make sure the following PHP extensions are enabled in your `php.ini` file:  
```
extension=pdo_sqlite
extension=sqlite3
```


Then, run the following commands to install dependencies and set up the project:  
```bash
composer install
npm install
php artisan migrate
npm run build
```

Task Overview

Please review the following files and directories in the project:
```
    app/Documents

    routes/web.php

    app/Enums/DocumentType

    app/Http/Controllers/DocumentController.php
```

Functional Requirements

**Form on the Welcome Page**
- Create a form on the Welcome page that submits a POST request to /documents/store.
The form should send only one field (any field, value does not matter).

**Document Type Enforcement**
 - Without modifying the constructor method of the Documents class, ensure that all documents have a type field of the DocumentType enum type (text field).

**Document Types**
 - Enforce two types of documents:

        Documents with a unique number

        Documents with a system-generated number

It is recommended to implement this distinction via interfaces.

**Create two document classes:**
```
        Invoice

        Pro Forma
```

**Model Relationships** - 
    Add the appropriate relationship in the Models\Document class.

**Database Saving Logic** - 
Extend the saveToDatabase method in app/Documents/Document.php to support saving these document types correctly.
Also, update the relations in app/Models/Document.php.

Verification

You can verify the saved records by running:
```
php artisan tinker
\App\Models\Document::with('items')->get()
```
