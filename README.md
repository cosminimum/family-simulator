# Educational OOP in PHP7.4 w MySQL

- PHP -v: 7.4
- Design Patterns used: MVC
- Database: MySQL
- Other: Composer / PHPUnit

## Installation
1. `Navigate in root directory`
2. `docker compose up -d`
3. `A container caller FS_CLIENT should be created`

## Unit Testing
`./vendor/phpunit whatever test`

## What could be improved

### 1. Template rendering
### 2. Database wrapper
### 3. Business logic validators
I would have splitted the `FamilyMemberValidator`, into:
- `ParentValidator`
- `ChildValidator`
- `AdoptedChildValidator`
- `PetValidator`

So that, every validator will have single responsibility. 