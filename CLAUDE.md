# task — тестово задание за работа с документи (Laravel + Vue starter kit)

Laravel 12 (PHP ^8.2), Vue 3 + Inertia, Vite, SQLite, Pest/PHPUnit тестове. Комуникация с потребителя: български. Код, commit-и и PR-и: английски.

Работният флоу (issue-та, PR-и) идва от плъгина `gws@claude-flow` — `/gws:issue <N>`. Този файл носи само спецификите на проекта.

## Branch-ове
- Базов branch: `main`. Issue branch-ове: `fix|feat|chore/N-kratko-ime` от него, PR към него, squash merge.
- Issue-то се затваря с `Fixes #N` в тялото на commit-а (базовият branch е default — затваря се при merge на PR-а).

## Deploy
- Няма — проектът не се качва на сървър. `/gws:ship` не е приложим тук; доставката е merge в базовия branch.

## Build и commit-и
- Frontend build: `npm run build` (Vite). Тестове: `php artisan test` (Pest/PHPUnit).
- Има pre-commit hook от пакета `givanov95/laravel-git-hooks`; при гърмящи тестове, несвързани с промяната, може да се ползва `SKIP_HOOK=1`.
- Commit стил: Conventional Commits на английски (`fix(scope): ...`).

## GitHub
- Нови issue-та се добавят в project board „gws".
