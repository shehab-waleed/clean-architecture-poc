# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel 12 application implementing **Clean Architecture** principles with a custom `src/` directory structure. The project separates business logic from framework dependencies using a layered architecture approach.

## Architecture

### Layer Structure

The codebase follows Clean Architecture with these distinct layers in `src/`:

1. **Domain Layer** (`src/domain/`)
   - Core business entities and rules
   - Contains Models (e.g., `User.php` - immutable, readonly classes)
   - Value Objects (e.g., `Email.php` - validated, immutable value types)
   - Contracts/Interfaces (e.g., `IUserRepository.php`)
   - No framework dependencies - pure PHP

2. **Application Layer** (`src/application/`)
   - Use cases and business workflows
   - Command/Query pattern implementation
   - Command handlers orchestrate domain operations
   - Example: `CreateUserCommandHandler` takes `CreateUserCommand`, uses repository to create User, returns `CreateUserResponse`

3. **Infrastructure Layer** (`src/infrastructure/`)
   - External dependencies and implementations
   - Repository implementations
   - Currently minimal/empty (repositories not yet implemented)

4. **API Layer** (`src/api/`)
   - HTTP layer - Controllers and Requests
   - Controllers depend on Application layer command handlers
   - Form requests for validation
   - Converts HTTP input to Commands, handles responses

### Key Architectural Patterns

- **Dependency Flow**: API → Application → Domain (dependencies point inward)
- **Immutability**: Domain models use `readonly` classes with constructor property promotion
- **Command Pattern**: Application layer uses Commands and CommandHandlers for use cases
- **Repository Pattern**: Domain defines interfaces, Infrastructure provides implementations
- **Value Objects**: Domain validation encapsulated in value objects (e.g., Email validates format)

### Autoloading

The `Src\` namespace maps to `src/` directory (configured in `composer.json`). Standard Laravel `App\` namespace maps to `app/` which is used only for framework providers.

## Development Commands

### Running the Application

```bash
# Start all services (server, queue, logs, vite) concurrently
composer dev

# Individual services
php artisan serve                    # Development server
php artisan queue:listen --tries=1   # Queue worker
php artisan pail --timeout=0         # Log viewer
npm run dev                          # Vite dev server
```

### Testing

```bash
# Run all tests (Pest framework)
composer test
# Or directly:
php artisan test

# Run specific test suite
php artisan test --testsuite=Unit
php artisan test --testsuite=Feature

# Run specific test file
php artisan test tests/Unit/ExampleTest.php

# Pest native commands
./vendor/bin/pest
./vendor/bin/pest --filter=test_name
```

### Code Quality

```bash
# Format code (Laravel Pint)
./vendor/bin/pint

# Format specific files/directories
./vendor/bin/pint src/
./vendor/bin/pint app/
```

### Database

```bash
# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Fresh migration with seeding
php artisan migrate:fresh --seed
```

### Build Assets

```bash
# Development
npm run dev

# Production build
npm run build
```

## Adding New Features

When implementing new features following Clean Architecture:

1. **Start with Domain**
   - Create domain models as `readonly` classes in `src/domain/Models/`
   - Add value objects in `src/domain/ValueObjects/` with validation
   - Define repository interfaces in `src/domain/Contracts/`

2. **Implement Application Layer**
   - Create Command class (data transfer object) in `src/application/Commands/`
   - Create CommandHandler that uses domain contracts
   - Create Response class for returning data

3. **Add Infrastructure**
   - Implement repository interfaces in `src/infrastructure/Repositories/`
   - Bind interfaces to implementations in `AppServiceProvider`

4. **Expose via API**
   - Create FormRequest for validation in `src/api/Requests/`
   - Create Controller in `src/api/Controllers/`
   - Inject CommandHandler, convert request to Command, return response

5. **Register Routes**
   - Add routes in `routes/web.php` or create `routes/api.php` if needed

## Testing Strategy

- **Unit Tests**: Test domain models, value objects, and application layer logic in isolation
- **Feature Tests**: Test complete HTTP request flow through all layers
- Pest is the testing framework (PHPUnit alternative)
- Tests extend `Tests\TestCase::class` which provides Laravel testing helpers

## Important Conventions

- Domain models are immutable (`readonly` classes)
- All domain classes have constructor property promotion
- Value objects validate in constructor, throw `InvalidArgumentException` on invalid input
- Commands are simple DTOs with getters
- CommandHandlers contain use case logic
- Repository interfaces in domain, implementations in infrastructure
- Controllers are thin - only handle HTTP concerns, delegate to command handlers
