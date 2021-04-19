https://laravel.com/docs/8.x/installation

# 1.Prologue
## 1-1.Getting Started

## 1-2.Installation
### Meet Laravel
#### Why Laravel?
### Your First Laravel Project
#### Getting Started On macOS
#### Getting Started On Windows
#### Getting Started On Linux
#### Choosing Your Sail Services
#### Installation Via Composer
### Initial Configuration
#### Environment Based Configuration
#### Directory Configuration
### Next Steps
#### Laravel The Full Stack Framework
#### Laravel The API Backend

## 1-3.Configuration
### Introduction
### Environment Configuration
#### Environment Variable Types
#### Retrieving Environment Configuration
#### Determining The Current Environment
### Accessing Configuration Values
### Configuration Caching
- php artisan config:cache
### Debug Mode
### Maintenance Mode
- php artisan down
- php artisan up

## 1-4.Directory Structure
### Introduction
### The Root Directory
#### The app Directory
#### The bootstrap Directory
- app.php
#### The config Directory
#### The database Directory
#### The public Directory
- index.php
- images
- JavaScript
- CSS
#### The resources Directory
- views
- JavaScript
- CSS
#### The routes Directory
- web.php
- api.php
- console.php
- channels.php
#### The storage Directory
#### The tests Directory
- phpunit
- php vendor/bin/phpunit
- php artisan test
#### The vendor Directory
- Composer
### The App Directory
#### The Broadcasting Directory
- make:channel
#### The Console Directory
- make:command
#### The Events Directory
- event:generate
- make:event
#### The Exceptions Directory
#### The Http Directory
#### The Jobs Directory
- make:job
#### The Listeners Directory
- event:generate
- make:listener
#### The Mail Directory
- make:mail
- Mail::send 
#### The Models Directory
- Eloquent model classes
#### The Notifications Directory
- make:notification
#### The Policies Directory
- make:policy
#### The Providers Directory
#### The Rules Directory
- make:rule

## 1-5.Starter Kits
### Introduction
### Laravel Breeze
- simple authentication features
#### Installation
### Laravel Jetstream
- login
- registration
- email verification
- two-factor authentication
- session management
- API support via Laravel Sanctum
- optional team management

## 1-6.Deployment
### Introduction
### Server Requirements
### Server Configuration
#### Nginx
### Optimization
#### Autoloader Optimization
#### Optimizing Configuration Loading
- php artisan config:cache
#### Optimizing Route Loading
- php artisan route:cache
#### Optimizing View Loading
- php artisan view:cache
### Debug Mode
### Deploying With Forge / Vapor
- Laravel Forge
- Laravel Vapor(serverless deployment platform)

# 2.Architecture Concepts
## 2-1.Request Lifecycle
## 2-2.Service Container
## 2-3.Service Providers
## 2-4.Facades

# 3.The Basics
## 3-1.Routing
## 3-2.Middleware
## 3-3.CSRF Protection
## 3-4.Controllers
## 3-5.Requests
## 3-6.Responses
## 3-7.Views
## 3-8.Blade Templates
## 3-9.URL Generation
## 3-10.Session
## 3-11.Validation
## 3-12.Error Handling
## 3-13.Logging

# 4.Digging Deeper
## 4-1.Artisan Console
## 4-2.Broadcasting
## 4-3.Cache
## 4-4.Collections
## 4-5.Compiling Assets
## 4-6.Contracts
## 4-7.Events
## 4-8.File Storage
## 4-9.Helpers
## 4-10.HTTP Client
## 4-11.Localization
## 4-12.Mail
## 4-13.Notifications
## 4-14.Package Development
## 4-15.Queues
## 4-16.Task Scheduling

# 5.Security
## 5-1.Authentication
## 5-2.Authorization
## 5-3.Email Verification
## 5-4.Encryption
## 5-5.Hashing
## 5-6.Password Reset

# 6.Database
## 6-1.Getting Started
## 6-2.Query Builder
## 6-3.Pagination
## 6-4.Migrations
## 6-5.Seeding
## 6-6.Redis

# 7.Eloquent ORM
## 7-1.Getting Started
## 7-2.Relationships
## 7-3.Collections
## 7-4.Mutators / Casts
## 7-5.API Resources
## 7-6.Serialization

# 8.Testing
## 8-1.Getting Started
## 8-2.HTTP Tests
## 8-3.Console Tests
## 8-4.Browser Tests
## 8-5.Database
## 8-6.Mocking

# 9.Packages
## 9-1.Breeze
## 9-2.Cashier (Stripe)
## 9-3.Cashier (Paddle)
## 9-4.Dusk
## 9-5.Envoy
## 9-6.Fortify
## 9-7.Homestead
## 9-8.Horizon
## 9-9.Jetstream
## 9-10.Passport
## 9-11.Sail
## 9-12.Sanctum
## 9-13.Scout
## 9-14.Socialite
## 9-15.Telescope
## 9-16.Valet
