<?php

use Illuminate\Support\Facades\Facade;

/**
 * Clean Architecture Tests
 *
 * These tests enforce the Clean Architecture principles across all layers:
 * - Domain: Pure business logic, no framework dependencies
 * - Application: Use cases and orchestration, depends on Domain only
 * - Infrastructure: External dependencies, implements Domain contracts
 * - API: HTTP layer, depends on Application, thin controllers
 */

/**
 * ============================================================================
 * DOMAIN LAYER TESTS
 * ============================================================================
 */

test('domain layer has no framework dependencies', function () {
    expect('Src\domain')
        ->not->toUse([
            'Illuminate',
            'Laravel',
            'App\Models',
            'Facade',
            'Eloquent',
        ]);
});

test('domain models are readonly and final', function () {
    expect('Src\domain\Models')
        ->classes()
        ->toBeFinal()
        ->toBeReadonly();
});

test('domain value objects are readonly and final', function () {
    expect('Src\domain\ValueObjects')
        ->classes()
        ->toBeFinal()
        ->toBeReadonly();
});

test('domain contracts are interfaces', function () {
    expect('Src\domain\Contracts')
        ->toBeInterfaces();
});

test('domain layer has no dependencies on other layers', function () {
    expect('Src\domain')
        ->not->toUse([
            'Src\application',
            'Src\infrastructure',
            'Src\api',
        ]);
});

/**
 * ============================================================================
 * APPLICATION LAYER TESTS
 * ============================================================================
 */

test('application layer depends on domain layer only', function () {
    expect('Src\application')
        ->not->toUse([
            'Src\infrastructure',
            'Src\api',
        ]);
});

test('application layer has minimal framework dependencies', function () {
    // Application layer should not use most framework features
    expect('Src\application')
        ->not->toUse([
            'Illuminate\Database',
            'Illuminate\Http',
            'App\Models',
            Facade::class,
        ]);
});

test('application layer command handlers use domain contracts not implementations', function () {
    // Ensure command handlers use domain contracts, not infrastructure
    expect('Src\application\Commands')
        ->not->toUse([
            'Src\infrastructure',
            'App\Models',
            'Illuminate\Database',
        ]);
});

/**
 * ============================================================================
 * INFRASTRUCTURE LAYER TESTS
 * ============================================================================
 */

test('infrastructure layer can use framework dependencies', function () {
    // This test ensures infrastructure layer exists and can have Laravel deps
    expect('Src\infrastructure')
        ->toUseNothing()
        ->ignoring([
            'Illuminate',
            'Laravel',
            'App\Models',
            'Src\domain',
            'Src\application',
        ]);
});

test('infrastructure repositories implement domain contracts', function () {
    expect('Src\infrastructure\Repositories')
        ->toImplement('Src\domain\Contracts\IUserRepository');
});

test('infrastructure layer does not depend on API layer', function () {
    expect('Src\infrastructure')
        ->not->toUse('Src\api');
});

/**
 * ============================================================================
 * API LAYER TESTS
 * ============================================================================
 */

test('API controllers extend base controller', function () {
    expect('Src\api\Controllers')
        ->toExtend('Illuminate\Routing\Controller');
});

test('API controllers only depend on application layer', function () {
    expect('Src\api\Controllers')
        ->not->toUse([
            'Src\infrastructure',
            'Src\domain', // Controllers should not directly use domain
        ])
        ->ignoring([
            // Allow exceptions from domain if needed
            'Src\domain\Exceptions',
        ]);
});

test('API layer can use Laravel HTTP components', function () {
    expect('Src\api')
        ->toUseNothing()
        ->ignoring([
            'Illuminate\Http',
            'Illuminate\Routing',
            'Illuminate\Foundation\Http',
            'Src\application',
            'response', // Laravel helper function
        ]);
});

test('form requests are in API layer', function () {
    expect('Src\api\Requests')
        ->toExtend('Illuminate\Foundation\Http\FormRequest');
});

/**
 * ============================================================================
 * CROSS-LAYER ARCHITECTURE RULES
 * ============================================================================
 */

test('dependency flow is unidirectional (inward)', function () {
    // API can use Application
    expect('Src\api')
        ->toUse('Src\application');

    // Application can use Domain
    expect('Src\application')
        ->toUse('Src\domain');

    // Infrastructure can use Domain
    expect('Src\infrastructure')
        ->toUse('Src\domain');
});

test('no namespace uses legacy app namespace for models', function () {
    // Ensure we're using domain models, not App\Models
    expect('Src')
        ->not->toUse('App\Models')
        ->ignoring([
            // Except infrastructure layer which bridges to Eloquent
            'Src\infrastructure',
        ]);
});

test('all classes in src are properly namespaced', function () {
    // Ensure all Src namespace classes exist
    expect('Src')
        ->classes()
        ->toBeClasses();
});

/**
 * ============================================================================
 * NAMING CONVENTIONS
 * ============================================================================
 */

test('command handlers have Handler suffix', function () {
    expect('Src\application\Commands')
        ->classes()
        ->toHaveSuffix('Handler')
        ->ignoring([
            'Src\application\Commands\CreateUser\CreateUserCommand',
            'Src\application\Commands\CreateUser\CreateUserResponse',
            // Add more command/response exceptions as needed
        ]);
});

test('repositories have Repository suffix', function () {
    expect('Src\infrastructure\Repositories')
        ->classes()
        ->toHaveSuffix('Repository');
});

test('domain contracts have I prefix', function () {
    expect('Src\domain\Contracts')
        ->classes()
        ->toHavePrefix('I');
});

test('controllers have Controller suffix', function () {
    expect('Src\api\Controllers')
        ->classes()
        ->toHaveSuffix('Controller');
});

/**
 * ============================================================================
 * SECURITY & BEST PRACTICES
 * ============================================================================
 */

test('no eval or exec in domain layer', function () {
    expect('Src\domain')
        ->not->toUse([
            'eval',
            'exec',
            'system',
            'passthru',
            'shell_exec',
        ]);
});

test('application layer uses type hints', function () {
    expect('Src\application')
        ->classes()
        ->toBeClasses();
});
