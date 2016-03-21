# scrum-sticky-notes

Original idea & first code: Aurélien Lemaitre (https://github.com/neorel)

Little script to convert a list of tasks/user stories in a printable PDF file to print on sticky notes.

## How to use

Edit `config.php` and create a `jira-config.php` file (use `jira-config.example.php`).
You need to populate `jira-config.php` with your current JIRA credentials and project list.

```
composer install
php sticky-notes.php
```
