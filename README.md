# scrum-sticky-notes

Original idea & first code: Aurélien Lemaitre (https://github.com/neorel)

Little script to convert a list of tasks/user stories in a printable PDF file to print on sticky notes.

## How to use

Edit `config.php` and create a `mapping.php` file (use `mapping.php.example`).
You need to generate a tsv (Tabulation-separated value) file with all your tasks (see `config.php`).

```
composer install
php sticky-notes.php
```
