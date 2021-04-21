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
### Introduction
### Lifecycle Overview
#### First Steps
- public/index.php
- bootstrap/app.php
#### HTTP / Console Kernels
- app/Http/Kernel.php
#### Service Providers
- config/app.php
#### Routing
- App\Providers\RouteServiceProvider
#### Finishing Up
### Focus On Service Providers
- app/Providers

## 2-2.Service Container
### Introduction
#### Zero Configuration Resolution
#### When To Use The Container
### Binding
#### Binding Basics
- $this->app->bind
- App::bind
- $this->app->singleton
- $this->app->instance
#### Binding Interfaces To Implementations
#### Contextual Binding
#### Binding Primitives
#### Binding Typed Variadics
#### Tagging
- $this->app->tag
#### Extending Bindings
- $this->app->extend
### Resolving
#### The Make Method
- $this->app->make
- $this->app->makeWith
- App::make
#### Automatic Injection
### Container Events
- $this->app->resolving
### PSR-11

## 2-3.Service Providers
### Introduction
### Writing Service Providers
- php artisan make:provider
#### The Register Method
#### The Boot Method
### Registering Providers
### Deferred Providers

## 2-4.Facades
### Introduction
- view
- response
- url
- config
### When To Use Facades
#### Facades Vs. Dependency Injection
#### Facades Vs. Helper Functions
### How Facades Work
### Real-Time Facades
### Facade Class Reference

# 3.The Basics
## 3-1.Routing
### Basic Routing
- Route::get
- routes/web.php
- Route::get($uri, $callback);
- Route::post($uri, $callback);
- Route::put($uri, $callback);
- Route::patch($uri, $callback);
- Route::delete($uri, $callback);
- Route::options($uri, $callback);
- Route::match
#### Redirect Routes
- Route::redirect('/here', '/there');
- Route::permanentRedirect('/here', '/there');
#### View Routes
- Route::view('/welcome', 'welcome');
- Route::view('/welcome', 'welcome', ['name' => 'Taylor']);
### Route Parameters
#### Required Parameters
#### Optional Parameters
#### Regular Expression Constraints
### Named Routes
### Route Groups
#### Middleware
- Route::middleware
#### Subdomain Routing
- Route::domain
#### Route Prefixes
- Route::prefix
#### Route Name Prefixes
- Route::name
### Route Model Binding
#### Implicit Binding
#### Explicit Binding
### Fallback Routes
- Route::fallback
### Rate Limiting
- RateLimiter::for
#### Defining Rate Limiters
#### Attaching Rate Limiters To Routes
### Form Method Spoofing
### Accessing The Current Route
### Cross-Origin Resource Sharing (CORS)
### Route Caching
- php artisan route:cache
- php artisan route:clear

## 3-2.Middleware
### Introduction
### Defining Middleware
- php artisan make:middleware 
### Registering Middleware
#### Global Middleware
- app/Http/Kernel.php 
#### Assigning Middleware To Routes
#### Middleware Groups
#### Sorting Middleware
### Middleware Parameters
### Terminable Middleware

## 3-3.CSRF Protection
### Introduction
### Preventing CSRF Requests
#### Excluding URIs
### X-CSRF-Token
### X-XSRF-Token

## 3-4.Controllers
### Introduction
### ### Writing Controllers
#### Basic Controllers
#### Single Action Controllers
- public function __invoke()
- php artisan make:controller ProvisionServer --invokable
### Controller Middleware
- $this->middleware
### Resource Controllers
- php artisan make:controller PhotoController --resource
- Route::resource
- php artisan make:controller PhotoController --resource --model=Photo
#### Partial Resource Routes
- Route::apiResource
- php artisan make:controller PhotoController --api
#### Nested Resources
#### Naming Resource Routes
#### Naming Resource Route Parameters
#### Scoping Resource Routes
#### Localizing Resource URIs
#### Supplementing Resource Controllers
### Dependency Injection & Controllers

## 3-5.Requests
### Introduction
### Interacting With The Request
#### Accessing The Request
#### Request Path & Method
- $uri = $request->path();
#### Request Headers
- $value = $request->header('X-Header-Name');
#### Request IP Address
- $ipAddress = $request->ip();
#### Content Negotiation
- $contentTypes = $request->getAcceptableContentTypes();
- if ($request->accepts(['text/html', 'application/json'])) {
    // ...
}
- $preferred = $request->prefers(['text/html', 'application/json']);
- if ($request->expectsJson()) {
    // ...
}
#### PSR-7 Requests
- composer require symfony/psr-http-message-bridge
- composer require nyholm/psr7
### Input
#### Retrieving Input
- $input = $request->all();
- $input = $request->input();
- $query = $request->query();
#### Determining If Input Is Present
#### Old Input
- $request->flash();
- $request->flashOnly
- $request->flashExcept
- return redirect('form')->withInput();
- $username = $request->old('username');
#### Cookies
- $value = $request->cookie('name');
#### Input Trimming & Normalization
### Files
#### Retrieving Uploaded Files
- $file = $request->file('photo');
- $file = $request->photo;
- if ($request->hasFile('photo'))
- if ($request->file('photo')->isValid())
- $path = $request->photo->path();
- $extension = $request->photo->extension();
#### Storing Uploaded Files
- $path = $request->photo->store('images');
- $path = $request->photo->storeAs('images', 'filename.jpg');
### Configuring Trusted Proxies
### Configuring Trusted Hosts

## 3-6.Responses
### Creating Responses
#### Attaching Headers To Responses
#### Attaching Cookies To Responses
#### Cookies & Encryption
### Redirects
#### Redirecting To Named Routes
#### Redirecting To Controller Actions
#### Redirecting To External Domains
#### Redirecting With Flashed Session Data
### Other Response Types
#### View Responses
- return response()->view
#### JSON Responses
- return response()->json
#### File Downloads
- return response()->download
- return response()->streamDownload
#### File Responses
- return response()->file
### Response Macros

## 3-7.Views
### Introduction
- resources/views/greeting.blade.php
### Creating & Rendering Views
- return View::make
#### Nested View Directories
#### Creating The First Available View
- return View::first
#### Determining If A View Exists
- View::exists
### Passing Data To Views
- return view
#### Sharing Data With All Views
### View Composers
- View::composer
#### View Creators
- View::creator
### Optimizing Views
- php artisan view:cache
- php artisan view:clear

## 3-8.Blade Templates
### Introduction
### Displaying Data
- var app = @json($array);
- {{ }}
#### HTML Entity Encoding
- escape
- {!! $name !!}
#### Blade & JavaScript Frameworks
- @@json()
### Blade Directives
#### If Statements
- @if
- @elseif
- @else
- @endif
- @unless 
- @endunless
- @isset
- @endisset
- @empty
- @endempty
- @auth
- @endauth
- @guest
- @endguest
- @production
- @endproduction
- @env
- @endenv
- @hasSection
- @endif
- @sectionMissing
- @endif
#### Switch Statements
- @switch
- @case
- @break
- @default
- @endswitch 
#### Loops
- @for
- @endfor
- @foreach 
- @endforeach
- @empty
- @endforelse
- @while
- @endwhile
- @continue
- @break
#### The Loop Variable
#### Comments
- {{-- comment --}}
#### Including Subviews
- @include
- @includeIf
- @includeWhen
- @includeUnless
- @includeFirst
- @each
#### The @once Directive
- @once
#### Raw PHP
- @php
- @endphp
### Components
- php artisan make:component
#### Rendering Components
#### Passing Data To Components
#### Component Attributes
- {{ $attributes }}
#### Reserved Keywords
- data
- render
- resolveView
- shouldRender
- view
- withAttributes
- withName
#### Slots
- {{ $slot }}
#### Inline Component Views
- php artisan make:component Alert --inline
#### Anonymous Components
- @props
#### Dynamic Components
#### Manually Registering Components
### Building Layouts
#### Layouts Using Components
#### Layouts Using Template Inheritance
- @show
- @section
- @endsection
- @yield
- @extends
- @parent
### Forms
#### CSRF Field
- @csrf
#### Method Field
- @method
#### Validation Errors
- @error
- @enderror
### Stacks
- @push
- @endpush
- @prepend
- @endprepend
### Service Injection
- @inject
### Extending Blade
#### Custom If Statements
- Blade::if

## 3-9.URL Generation
### Introduction
### The Basics
#### Generating URLs
- echo url
#### Accessing The Current URL
- echo url()->current();
- echo URL::current();
- echo url()->full();
- echo url()->previous();
### URLs For Named Routes
#### Signed URLs
- return URL::signedRoute
- return URL::temporarySignedRoute
- hasValidSignature
### URLs For Controller Actions
### Default Values

## 3-10.Session
### Introduction
#### Configuration
- config/session.php
- file
- cookie
- database
- memcached / redis
- dynamodb
- array
#### Driver Prerequisites
- Database
- Schema::create
- php artisan session:table
- php artisan migrate
### Interacting With The Session
#### Retrieving Data
- $data = $request->session()->all();
#### Storing Data
- $request->session()->put('key', 'value');
- session(['key' => 'value']);
- $request->session()->push
- $value = $request->session()->pull
- $request->session()->increment
- $request->session()->decrement
#### Flash Data
- $request->session()->flash
- $request->session()->reflash();
- $request->session()->keep
- $request->session()->now
#### Deleting Data
- $request->session()->forget
- $request->session()->flush();
#### Regenerating The Session ID
- $request->session()->regenerate();
- $request->session()->invalidate();
### Session Blocking
- block
### Adding Custom Session Drivers
#### Implementing The Driver
- open
- close
- read
- write
- destroy
- gc
#### Registering The Driver

## 3-11.Validation
### Introduction
### Validation Quickstart
#### Defining The Routes
#### Creating The Controller
#### Writing The Validation Logic
#### Displaying The Validation Error
- @error
- @enderror
#### Repopulating Forms
#### A Note On Optional Fields
### Form Request Validation
#### Creating Form Requests
- php artisan make:request StorePostRequest
- $stopOnFirstFailure
#### Authorizing Form Requests
#### Customizing The Error Messages
#### Preparing Input For Validation
### Manually Creating Validators
- $validator = Validator::make
- $validator->stopOnFirstFailure()->fails()
#### Automatic Redirection
- validateWithBag
#### Named Error Bags
- withErrors
#### Customizing The Error Messages
#### After Validation Hook
- $validator->after
### Working With Error Messages
- $errors = $validator->errors();
- echo $errors->first('email');
- foreach ($errors->get('email') as $message)
- foreach ($errors->all() as $message)
#### Specifying Custom Messages In Language Files
#### Specifying Attributes In Language Files
#### Specifying Values In Language Files
### Available Validation Rules
Accepted
Active URL
After (Date)
After Or Equal (Date)
Alpha
Alpha Dash
Alpha Numeric
Array
Bail
Before (Date)
Before Or Equal (Date)
Between
Boolean
Confirmed
Date
Date Equals
Date Format
Different
Digits
Digits Between
Dimensions (Image Files)
Distinct
Email
Ends With
Exclude If
Exclude Unless
Exists (Database)
File
Filled
Greater Than
Greater Than Or Equal
Image (File)
In
In Array
Integer
IP Address
JSON
Less Than
Less Than Or Equal
Max
MIME Types
MIME Type By File Extension
Min
Multiple Of
Not In
Not Regex
Nullable
Numeric
Password
Present
Prohibited
Prohibited If
Prohibited Unless
Regular Expression
Required
Required If
Required Unless
Required With
Required With All
Required Without
Required Without All
Same
Size
Sometimes
Starts With
String
Timezone
Unique (Database)
URL
UUID
### Conditionally Adding Rules
### Validating Arrays
### Custom Validation Rules
#### Using Rule Objects
- php artisan make:rule Uppercase
#### Using Closures
#### Implicit Rules

## 3-12.Error Handling
### Introduction
### Configuration
### The Exception Handler
#### Reporting Exceptions
- $this->reportable(
#### Ignoring Exceptions By Type
#### Rendering Exceptions
#### Reportable & Renderable Exceptions
### HTTP Exceptions
- abort(404);
#### Custom HTTP Error Pages

## 3-13.Logging
### Introduction
### Configuration
#### Available Channel Drivers
#### Channel Prerequisites
### Building Log Stacks
### Writing Log Messages
- Log::emergency($message);
- Log::alert($message);
- Log::critical($message);
- Log::error($message);
- Log::warning($message);
- Log::notice($message);
- Log::info($message);
- Log::debug($message);
#### Writing To Specific Channels
### Monolog Channel Customization
#### Customizing Monolog For Channels
#### Creating Monolog Handler Channels
#### Creating Custom Channels Via Factories

# 4.Digging Deeper
## 4-1.Artisan Console
### Introduction
#### Tinker (REPL)
- tinker.php
- 'commands' =>
- 'dont_alias' =>
### Writing Commands
#### Generating Commands
- php artisan make:command 
#### Command Structure
#### Closure Commands
### Defining Input Expectations
#### Arguments
#### Options
- two hyphens (--) 
#### Input Arrays
-  * character
#### Input Descriptions
### Command I/O
#### Retrieving Input
#### Prompting For Input
- $this->ask
- $this->secret
- $this->confirm
- $this->anticipate
- $this->choice
#### Writing Output
- $this->info
- $this->error
- $this->line
- $this->newLine();
- $this->table
- $this->withProgressBar
### Registering Commands
- $this->load
### Programmatically Executing Commands
- Artisan::call
- Artisan::queue
#### Calling Commands From Other Commands
- $this->call
- $this->callSilently
### Signal Handling
### Stub Customization
- php artisan stub:publish
### Events

## 4-2.Broadcasting
### Introduction
### Server Side Installation
#### Configuration
- config/broadcasting.php 
#### Pusher Channels
- composer require pusher/pusher-php-server "^5.0"
- config/broadcasting.php
  - PUSHER_APP_ID=your-pusher-app-id
  - PUSHER_APP_KEY=your-pusher-key
  - PUSHER_APP_SECRET=your-pusher-secret
  - PUSHER_APP_CLUSTER=mt1
- .env
  - BROADCAST_DRIVER=pusher
#### Ably
- composer require ably/ably-php
- config/broadcasting.php
  - ABLY_KEY=your-ably-key
- .env
  - BROADCAST_DRIVER=ably
#### Open Source Alternatives
### Client Side Installation
#### Pusher Channels
- npm install --save-dev laravel-echo pusher-js
- npm run dev
#### Ably
- npm install --save-dev laravel-echo pusher-js
- npm run dev
### Concept Overview
#### Using An Example Application
### Defining Broadcast Events
#### Broadcast Name
#### Broadcast Data
#### Broadcast Queue
#### Broadcast Conditions
#### Broadcasting & Database Transactions
### Authorizing Channels
#### Defining Authorization Routes
- Broadcast::routes();
#### Defining Authorization Callbacks
#### Defining Channel Classes
- php artisan make:channel
### Broadcasting Events
#### Only To Others
### Receiving Broadcasts
#### Listening For Events
- Echo.channel
- .listen
#### Leaving A Channel
- Echo.leaveChannel
- Echo.leave
#### Namespaces
### Presence Channels
#### Authorizing Presence Channels
#### Joining Presence Channels
-.join
.here
.joining
#### Broadcasting To Presence Channels
- broadcastOn
### Client Events
- .whisper
- .listenForWhisper
### Notifications
- .notification

## 4-3.Cache
### Introduction
### Configuration
- config/cache.php
#### Driver Prerequisites
### Cache Usage
#### Obtaining A Cache Instance
- Cache::store
#### Retrieving Items From The Cache
- Cache::get
- Cache::has
- Cache::increment
- Cache::decrement
- Cache::remember
- Cache::rememberForever
- Cache::pull
#### Storing Items In The Cache
- Cache::put
- Cache::add
- Cache::forever
#### Removing Items From The Cache
- Cache::forget
- ache::put
- Cache::flush
#### The Cache Helper
### Cache Tags
#### Storing Tagged Cache Items
- Cache::tags()->put();
#### Accessing Tagged Cache Items
- Cache::tags()->get();
#### Removing Tagged Cache Items
- Cache::tags()->flush();
### Atomic Locks
#### Driver Prerequisites
#### Managing Locks
- Cache::lock
#### Managing Locks Across Processes
### Adding Custom Cache Drivers
#### Writing The Driver
- Cache::extend
#### Registering The Driver
### Events

## 4-4.Collections
### Introduction
#### Creating Collections
#### Extending Collections
- Collection::macro
### Available Methods
all
average
avg
chunk
chunkWhile
collapse
collect
combine
concat
contains
containsStrict
count
countBy
crossJoin
dd
diff
diffAssoc
diffKeys
dump
duplicates
duplicatesStrict
each
eachSpread
every
except
filter
first
firstWhere
flatMap
flatten
flip
forget
forPage
get
groupBy
has
implode
intersect
intersectByKeys
isEmpty
isNotEmpty
join
keyBy
keys
last
macro
make
map
mapInto
mapSpread
mapToGroups
mapWithKeys
max
median
merge
mergeRecursive
min
mode
nth
only
pad
partition
pipe
pipeInto
pluck
pop
prepend
pull
push
put
random
reduce
reject
replace
replaceRecursive
reverse
search
shift
shuffle
skip
skipUntil
skipWhile
slice
some
sort
sortBy
sortByDesc
sortDesc
sortKeys
sortKeysDesc
splice
split
splitIn
sum
take
takeUntil
takeWhile
tap
times
toArray
toJson
transform
union
unique
uniqueStrict
unless
unlessEmpty
unlessNotEmpty
unwrap
values
when
whenEmpty
whenNotEmpty
where
whereStrict
whereBetween
whereIn
whereInStrict
whereInstanceOf
whereNotBetween
whereNotIn
whereNotInStrict
whereNotNull
whereNull
wrap
zip
### Higher Order Messages
average
avg
contains
each
every
filter
first
flatMap
groupBy
keyBy
map
max
min
partition
reject
skipUntil
skipWhile
some
sortBy
sortByDesc
sum
takeUntil
takeWhile
unique
### Lazy Collections
#### Introduction
#### Creating Lazy Collections
#### The Enumerable Contract
#### Lazy Collection Methods
- LazyCollection::make

## 4-5.Compiling Assets
### Introduction
### Installation & Setup
### Running Mix
- npm run dev
- npm run prod
- npm run watch
- npm run watch-poll
### Working With Stylesheets
#### Tailwind CSS
#### PostCSS
#### Sass
#### URL Processing
- url()
#### Source Maps
- mix.sourceMaps()
### Working With JavaScript
#### Vue
#### React
#### Vendor Extraction
- .extract
#### Custom Webpack Configuration
- mix.webpackConfig
### Versioning / Cache Busting
- .version
- mix.inProduction
- mix_url
### Browsersync Reloading
- mix.browserSync()
### Environment Variables
- .env
    - MIX_SENTRY_DSN_PUBLIC=http://example.com
    - process.env.MIX_SENTRY_DSN_PUBLIC
### Notifications
- mix.disableNotifications();

## 4-6.Contracts
### Introduction
#### Contracts Vs. Facades
### When To Use Contracts
### How To Use Contracts
### Contract Reference

## 4-7.Events
### Introduction
### Registering Events & Listeners
#### Generating Events & Listeners
- php artisan event:generate
- php artisan make:event
#### Manually Registering Events
- queueable
- onConnection
- onQueue
- delay
- catch
- Throwable
- 'event.*'
#### Event Discovery
- handle
- discoverEventsWithin()
- event:cache
- event:clear
### Defining Events
### Defining Listeners
### Queued Event Listeners
- event:generate
- make:listener
- $connection
- $queue
- $delay
- viaQueue()
- shouldQueue
#### Manually Interacting With The Queue
- delete
- release
#### Queued Event Listeners & Database Transactions
#### Handling Failed Jobs
- $tries 
- retryUntil()
### Dispatching Events
- dispatch
### Event Subscribers
- subscribe
#### Writing Event Subscribers
#### Registering Event Subscribers

## 4-8.File Storage
### Introduction
### Configuration
#### The Local Driver
- storage/app/example.txt
#### The Public Disk
- php artisan storage:link
- echo asset
#### Driver Prerequisites
- config/filesystems.php
#### Caching
### Obtaining Disk Instances
- Storage::put
- Storage::disk
### Retrieving Files
- Storage::get
- Storage::disk('s3')->exists
- Storage::disk('s3')->missing(
#### Downloading Files
- Storage::download
#### File URLs
- Storage::url
- Storage::temporaryUrl
#### File Metadata
- Storage::size
- Storage::lastModified
- Storage::path
### Storing Files
- Storage::put
- Storage::putFile
- Storage::putFileAs
- Storage::prepend
- Storage::append
- Storage::copy
- Storage::move
#### File Uploads
- Storage::putFile
- storeAs
- Storage::putFileAs
- store
- storeAs
- getClientOriginalName()
#### File Visibility
- Storage::getVisibility
- Storage::setVisibility
- storePublicly
- storePubliclyAs
### Deleting Files
- Storage::delete
- Storage::disk('s3')->delete
### Directories
- Storage::files
- Storage::allFiles
- Storage::directories
- Storage::allDirectories
- Storage::makeDirectory
- Storage::deleteDirectory
### Custom Filesystems
- composer require spatie/flysystem-dropbox

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
