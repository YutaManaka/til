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
### Available Methods
#### Arrays & Objects
Arr::accessible
Arr::add
Arr::collapse
Arr::crossJoin
Arr::divide
Arr::dot
Arr::except
Arr::exists
Arr::first
Arr::flatten
Arr::forget#### Paths
Arr::get
Arr::has
Arr::hasAny
Arr::isAssoc
Arr::last
Arr::only
Arr::pluck
Arr::prepend
Arr::pull
Arr::query
Arr::random
Arr::set
Arr::shuffle
Arr::sort
Arr::sortRecursive
Arr::where
Arr::wrap
data_fill
data_get
data_set
head
last
#### Paths
app_path
base_path
config_path
database_path
mix
public_path
resource_path
storage_path
#### Strings
__
class_basename
e
preg_replace_array
Str::after
Str::afterLast
Str::ascii
Str::before
Str::beforeLast
Str::between
Str::camel
Str::contains
Str::containsAll
Str::endsWith
Str::finish
Str::is
Str::isAscii
Str::isUuid
Str::kebab
Str::length
Str::limit
Str::lower
Str::markdown
Str::orderedUuid
Str::padBoth
Str::padLeft
Str::padRight
Str::plural
Str::pluralStudly
Str::random
Str::remove
Str::replaceArray
Str::replaceFirst
Str::replaceLast
Str::singular
Str::slug
Str::snake
Str::start
Str::startsWith
Str::studly
Str::substr
Str::substrCount
Str::title
Str::ucfirst
Str::upper
Str::uuid
Str::words
trans
trans_choice
#### Fluent Strings
after
afterLast
append
ascii
basename
before
beforeLast
camel
contains
containsAll
dirname
endsWith
exactly
explode
finish
is
isAscii
isEmpty
isNotEmpty
kebab
length
limit
lower
ltrim
markdown
match
matchAll
padBoth
padLeft
padRight
pipe
plural
prepend
remove
replace
replaceArray
replaceFirst
replaceLast
replaceMatches
rtrim
singular
slug
snake
split
start
startsWith
studly
substr
tap
test
title
trim
ucfirst
upper
when
whenEmpty
words
#### URLs
action
asset
route
secure_asset
secure_url
url
#### Miscellaneous
abort
abort_if
abort_unless
app
auth
back
bcrypt
blank
broadcast
cache
class_uses_recursive
collect
config
cookie
csrf_field
csrf_token
dd
dispatch
dump
env
event
filled
info
logger
method_field
now
old
optional
policy
redirect
report
request
rescue
resolve
response
retry
session
tap
throw_if
throw_unless
today
trait_uses_recursive
transform
validator
value
view
with

## 4-10.HTTP Client
### Introduction
### Making Requests
- Http::get
- $response->body() : string;
- $response->json() : array|mixed;
- $response->collect() : Illuminate\Support\Collection;
- $response->status() : int;
- $response->ok() : bool;
- $response->successful() : bool;
- $response->failed() : bool;
- $response->serverError() : bool;
- $response->clientError() : bool;
- $response->header($header) : string;
- $response->headers() : array;
- return Http::dd()->get
#### Request Data
- Http::post
- Http::get
- Http::asForm()->post
- Http::withBody
- Http::attach
- fopen
#### Headers
- Http::withHeaders
#### Authentication
- Http::withBasicAuth
- Http::withDigestAuth
- Http::withToken
#### Timeout
- Http::timeout(3)->get(...);
#### Retries
- Http::retry(3, 100)->post(...);
#### Error Handling
- $response->successful();
- $response->failed();
- $response->clientError();
- $response->serverError();
- $response->throw();
- return Http::post(...)->throw()->json();
#### Guzzle Options
- Http::withOptions
### Concurrent Requests
- Http::pool
### Testing
#### Faking Responses
- Http::fake();
- Http::response
- Http::sequence
#### Inspecting Requests
- Http::withHeaders
- Http::assertSent
- Http::assertNotSent
- Http::assertNothingSent();

## 4-11.Localization
### Introduction
- resources/lang
#### Configuring The Locale
- App::setLocale
- App::currentLocale
- App::isLocale
### Defining Translation Strings
#### Using Short Keys
#### Using Translation Strings As Keys
### Retrieving Translation Strings
- __ function
#### Replacing Parameters In Translation Strings
#### Pluralization
- trans_choice
### Overriding Package Language Files

## 4-12.Mail
### Introduction
#### Configuration
- config/mail.php
#### Driver Prerequisites
### Generating Mailables
- php artisan make:mail OrderShipped
### Writing Mailables
#### Configuring The Sender
- build
- from
#### Configuring The View
- text
#### View Data
- with
#### Attachments
- attach
- attachFromStorage
- attachFromStorageDisk
- attachData
#### Inline Attachments
- embed
- embedData
#### Customizing The SwiftMailer Message
- withSwiftMessage
### Markdown Mailables
#### Generating Markdown Mailables
- php artisan make:mail OrderShipped --markdown=
- markdown
#### Writing Markdown Messages
- @component
- @endcomponent
- 'mail::button'
- 'mail::panel'
- 'mail::table'
#### Customizing The Components
- php artisan vendor:publish --tag=
### Sending Mail
- Mail::to
- Mail::mailer
#### Queueing Mail
- queue
- later
- onConnection
- onQueue
### Rendering Mailables
#### Previewing Mailables In The Browser
### Localizing Mailables
- HasLocalePreference
### Testing Mailables
- assertSeeInHtml
- assertDontSeeInHtml
- assertSeeInText
- assertDontSeeInText.
### Mail & Local Development
### Events

## 4-13.Notifications
### Introduction
### Generating Notifications
- php artisan make:notification
### Sending Notifications
#### Using The Notifiable Trait
- use Notifiable;
- notify
#### Using The Notification Facade
- Notification::send
#### Specifying Delivery Channels
- via
#### Queueing Notifications
- use Queueable;
- $connection
- viaQueues
- $afterCommit
#### On-Demand Notifications
- Notification::route
### Mail Notifications
#### Formatting Mail Messages
- toMail
- view
- error
#### Customizing The Sender
- from
#### Customizing The Recipient
#### Customizing The Subject
#### Customizing The Mailer
- mailer
#### Customizing The Templates
- php artisan vendor:publish --tag=
#### Attachments
- attach
- attachFromStorage
- attachData
#### Using Mailables
- routeNotificationFor
#### Previewing Mail Notifications
### Markdown Mail Notifications
#### Generating The Message
- php artisan make:notification InvoicePaid --markdown=
- markdown
#### Writing The Message
- @component
- @endcomponent
- 'mail::message'
- 'mail::button'
- 'mail::panel'
- 'mail::table'
#### Customizing The Components
- php artisan vendor:publish --tag=
- theme
### Database Notifications
- php artisan notifications:table
- php artisan migrate
#### Prerequisites
#### Formatting Database Notifications
- toArray
#### Accessing The Notifications
- unreadNotifications
#### Marking Notifications As Read
- markAsRead
### Broadcast Notifications
#### Prerequisites
#### Formatting Broadcast Notifications
- toBroadcast
- onConnection
- onQueue
- broadcastType
- receivesBroadcastNotificationsOn
#### Listening For Notifications
### SMS Notifications
#### Prerequisites
- composer require laravel/nexmo-notification-channel nexmo/laravel
#### Formatting SMS Notifications
- toNexmo
- unicode
#### Formatting Shortcode Notifications
- toShortcode
#### Customizing The "From" Number
- from
#### Routing SMS Notifications
- routeNotificationForNexmo
### Slack Notifications
#### Prerequisites
- composer require laravel/slack-notification-channel
#### Formatting Slack Notifications
- toSlack
- from
- to
#### Slack Attachments
- attachment
- markdown
#### Routing Slack Notifications
- routeNotificationForSlack
### Localizing Notifications
- locale
- Notification::locale
- HasLocalePreference
### Notification Events
### Custom Channels

## 4-14.Package Development
### Introduction
#### A Note On Facades
### Package Discovery
- extra
- "dont-discover"
### Service Providers
### Resources
#### Configuration
- boot
- register
#### Migrations
- loadMigrationsFrom
#### Routes
- loadRoutesFrom
#### Translations
- loadTranslationsFrom
- echo trans
#### Views
- loadViewsFrom
- view
- publishes
#### View Components
- loadViewComponentsAs
### Commands
- commands
### Public Assets
- publishes
- php artisan vendor:publish --tag=public --force
### Publishing File Groups
- php artisan vendor:publish --tag=config

## 4-15.Queues
### Introduction
#### Connections Vs. Queues
- php artisan queue:work --queue=high,default
#### Driver Notes & Prerequisites
- php artisan queue:table
- php artisan migrate
### Creating Jobs
- php artisan make:job ProcessPodcast
#### Generating Job Classes
#### Class Structure
- handle
- withoutRelations
#### Unique Jobs
- ShouldBeUnique
- uniqueId
- uniqueFor
- ShouldBeUniqueUntilProcessing
- uniqueVia
### Job Middleware
- middleware
- make:job
#### Rate Limiting
- Limit::perMinute
- Limit::none
- Limit::perHour
- RateLimited
#### Preventing Job Overlaps
- WithoutOverlapping
- middleware
- dontRelease
#### Throttling Exceptions
- ThrottlesExceptions
- backoff
- by
### Dispatching Jobs
- dispatch
- dispatchIf
- dispatchUnless
#### Delayed Dispatching
- delay
- dispatchAfterResponse
- afterResponse
#### Synchronous Dispatching
- dispatchSync
#### Jobs & Database Transactions
- after_commit
- afterCommit
#### Job Chaining
- chain
- Bus::chain
- catch
- Throwable
#### Customizing The Queue & Connection
- onQueue
- onConnection
#### Specifying Max Job Attempts / Timeout Values
- php artisan queue:work --tries=3
- public $tries = 5;
- retryUntil
- release
- maxExceptions
- php artisan queue:work --timeout=30
#### Error Handling
- queue:work
- release
- fail
### Job Batching
- php artisan queue:batches-table
- php artisan migrate
#### Defining Batchable Jobs
- batch
#### Dispatching Batches
- Bus::batch
- then
- catch
- finally
- name
- onConnection
- onQueue
#### Adding Jobs To Batches
- add
#### Inspecting Batches
- $batch->id;
- $batch->name;
- $batch->totalJobs;
- $batch->pendingJobs;
- $batch->failedJobs;
- $batch->processedJobs();
- $batch->progress();
- $batch->finished();
- $batch->cancel();
- $batch->cancelled();
- Bus::findBatch
#### Cancelling Batches
- cancel
#### Batch Failures
- allowFailures
- php artisan queue:retry-batch 
#### Pruning Batches
- queue:prune-batches
- unfinished
### Queueing Closures
### Running The Queue Worker
#### The queue:work Command
- php artisan queue:work
- php artisan queue:listen
- php artisan queue:work redis
- php artisan queue:work redis --queue=emails
- php artisan queue:work --once
- php artisan queue:work --max-jobs=1000
- php artisan queue:work --stop-when-empty
- php artisan queue:work --max-time=3600
- php artisan queue:work --sleep=3
#### Queue Priorities
- php artisan queue:work --queue=high,low
#### Queue Workers & Deployment
- php artisan queue:restart
#### Job Expirations & Timeouts
- php artisan queue:work --timeout=60
### Supervisor Configuration
- sudo apt-get install supervisor
- sudo supervisorctl reread
- sudo supervisorctl update
- sudo supervisorctl start laravel-worker:*
### Dealing With Failed Jobs
- php artisan queue:failed-table
- php artisan migrate
- php artisan queue:work redis --tries=3
- php artisan queue:work redis --tries=3 --backoff=3
- backoff
#### Cleaning Up After Failed Jobs
- Throwable
- failed
#### Retrying Failed Jobs
- php artisan queue:failed
- php artisan queue:retry 5
- php artisan queue:retry --range=5-10
- php artisan:retry --queue=name
- php artisan queue:retry all
- php artisan queue:forget 5
- php artisan queue:flush
#### Ignoring Missing Models
- deleteWhenMissingModels
- Queue::failing
#### Failed Job Events
### Clearing Jobs From Queues
- php artisan queue:clear
- php artisan queue:clear redis --queue=emails
### Job Events
- Queue::before
- Queue::after
- Queue::looping

## 4-16.Task Scheduling
### Introduction
### Defining Schedules
- schedule
- __invoke
- php artisan schedule:list
#### Scheduling Artisan Commands
- command
#### Scheduling Queued Jobs
- job
#### Scheduling Shell Commands
- exec
#### Schedule Frequency Options
- days
- between
- when
- skip
- environments
#### Timezones
- timezone
- scheduleTimezone
#### Preventing Task Overlaps
- withoutOverlapping
#### Running Tasks On One Server
- onOneServer
#### Background Tasks
- runInBackground
#### Maintenance Mode
- evenInMaintenanceMode
### Running The Scheduler
- php artisan schedule:run
#### Running The Scheduler Locally
- php artisan schedule:work
### Task Output
- sendOutputTo
- emailOutputTo
- emailOutputOnFailure
### Task Hooks
- before
- after
- onSuccess
- onFailure
- pingBefore
- thenPing
- pingBeforeIf
- thenPingIf
- pingOnSuccess
- pingOnFailure

# 5.Security
## 5-1.Authentication
### Introduction
- config/auth.php
#### Starter Kits
#### Database Considerations
#### Ecosystem Overview
- Laravel Breeze
- Laravel Jetstream
- Laravel Fortify
- Laravel Sanctum
- Passport
### Authentication Quickstart
#### Install A Starter Kit
#### Retrieving The Authenticated User
- Auth::user();
- Auth::id();
- Auth::check()
#### Protecting Routes
- middleware('auth')
- return route('login');
- middleware('auth:admin');
#### Login Throttling
### Manually Authenticating Users
- Auth::attempt
- Auth::guard
#### Remembering Users
#### Other Authentication Methods
- Auth::login
- Auth::loginUsingId
- Auth::once
### HTTP Basic Authentication
- middleware('auth.basic')
- .htaccess
    - RewriteCond %{HTTP:Authorization} ^(.+)$
    - RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
#### Stateless HTTP Basic Authentication
- Auth::onceBasic
- middleware('auth.basic.once')
### Logging Out
- Auth::logout
#### Invalidating Sessions On Other Devices
- Auth::logoutOtherDevices
### Password Confirmation
#### Configuration
- config/auth.php
#### Routing
#### Protecting Routes
- middleware(['password.confirm'])
### Adding Custom Guards
- Auth::extend
- Auth::createUserProvider
#### Closure Request Guards
- Auth::viaRequest
### Adding Custom User Providers
- Auth::provider
#### The User Provider Contract
- retrieveById
- retrieveByToken
- updateRememberToken
- retrieveByCredentials
- validateCredentials
#### The Authenticatable Contract
- getAuthIdentifierName
- getAuthIdentifier
- getAuthPassword
- getRememberToken
- setRememberToken
- getRememberTokenName
### Social Authentication
### Events

## 5-2.Authorization
### Introduction
### Gates
#### Writing Gates
- Gate::define
#### Authorizing Actions
- Gate::allows
- Gate::forUser
- Gate::any
- Gate::none
- Gate::authorize
- Gate::check
#### Gate Responses
- Gate::inspect
#### Intercepting Gate Checks
- Gate::before
- Gate::after
### Creating Policies
#### Generating Policies
- php artisan make:policy PostPolicy
- php artisan make:policy PostPolicy --model=Post
#### Registering Policies
- PostPolicy
- Gate::guessPolicyNamesUsing
### Writing Policies
#### Policy Methods
#### Policy Responses
#### Methods Without Models
- create
#### Guest Users
#### Policy Filters
### Authorizing Actions Using Policies
- cannot
#### Via The User Model
#### Via Controller Helpers
- authorizeResource
#### Via Middleware
#### Via Blade Templates
- @can
- @endcan
- @cannot
- @elsecannot
- @endcannot
- @canany
- @elsecanany
- @endcanany
#### Supplying Additional Context

## 5-3.Email Verification
### Introduction
#### Model Preparation
#### Database Preparation
- php artisan migrate
### Routing
#### The Email Verification Notice
#### The Email Verification Handler
#### Resending The Verification Email
#### Protecting Routes
### Customization
### Events

## 5-4.Encryption
### Introduction
### Configuration
### Using The Encrypter
- Crypt::encryptString
- Crypt::decryptString

## 5-5.Hashing
### Introduction
### Configuration
### Basic Usage
#### Hashing Passwords
- Hash::make
#### Verifying That A Password Matches A Hash
- Hash::check
#### Determining If A Password Needs To Be Rehashed
- Hash::needsRehash

## 5-6.Password Reset
### Introduction
#### Model Preparation
#### Database Preparation
- php artisan migrate
#### Configuring Trusted Hosts
### Routing
#### Requesting The Password Reset Link
#### Resetting The Password
### Customization

# 6.Database
## 6-1.Getting Started
### Introduction
#### Configuration
- config/database.php
#### Read & Write Connections
### Running SQL Queries
- DB::select
- DB::insert
- DB::update
- DB::delete
- DB::statement
- DB::unprepared
#### Using Multiple Database Connections
- DB::connection
#### Listening For Query Events
### Database Transactions
- DB::transaction
- DB::beginTransaction
- DB::rollBack();
- DB::commit();
### Connecting To The Database CLI
- php artisan db
- php artisan db mysql

## 6-2.Query Builder
### Introduction
### Running Database Queries
- DB::table
- first
- value
- find
- pluck
#### Chunking Results
- chunk
- chunkById
#### Streaming Results Lazily
- lazyById
#### Aggregates
- count
- max
- min
- avg
- sum
- exists
- doesntExist
### Select Statements
- select
- distinct
- addSelect
### Raw Expressions
- DB::raw
- selectRaw
- whereRaw
- orWhereRaw
- havingRaw
- orHavingRaw
- orderByRaw
- groupByRaw
### Joins
- join
- leftJoin
- rightJoin
- crossJoin
- where
- orWhere
- joinSub
- leftJoinSub
- rightJoinSub
### Unions
- union
- unionAll
### Basic Where Clauses
#### Where Clauses
- where
#### Or Where Clauses
- orWhere
#### JSON Where Clauses
- whereJsonContains
- whereJsonLength
#### Additional Where Clauses
- whereBetween
- whereNotBetween
- whereIn
- whereNotIn
- orWhereIn
- orWhereNotIn
- whereNull
- whereNotNull
- orWhereNull
- orWhereNotNull
- whereDate
- whereMonth
- whereDay
- whereYear
- whereTime
- whereColumn
- orWhereColumn
#### Logical Grouping
### Advanced Where Clauses
#### Where Exists Clauses
- whereExists
#### Subquery Where Clauses
- User::where
### Ordering, Grouping, Limit & Offset
#### Ordering
- orderBy
- latest
- oldest
- inRandomOrder
- reorder
#### Grouping
- groupBy
- having
#### Limit & Offset
- skip
- skip
- limit
- offset
### Conditional Clauses
- when
### Insert Statements
- insert
- insertOrIgnore
- insertGetId
#### Upserts
- upsert
### Update Statements
- update
- updateOrInsert
#### Updating JSON Columns
#### Increment & Decrement
- increment
- decrement
### Delete Statements
- delete
- truncate
### Pessimistic Locking
- sharedLock
- lockForUpdate
### Debugging
- dd
- dump

## 6-3.Pagination
### Introduction
### Basic Usage
#### Paginating Query Builder Results
- paginate
- simplePaginate
#### Paginating Eloquent Results
#### Manually Creating A Paginator
#### Customizing Pagination URLs
- withPath
- appends
- withQueryString
- fragment
### Displaying Pagination Results
- links
#### Adjusting The Pagination Link Window
- onEachSide
#### Converting Results To JSON
### Customizing The Pagination View
- links
- defaultView
- defaultSimpleView
#### Using Bootstrap
- useBootstrap
### Paginator Instance Methods

## 6-4.Migrations
### Introduction
### Generating Migrations
- php artisan make:migration create_flights_table
#### Squashing Migrations
- php artisan schema:dump
- php artisan schema:dump --prune
### Migration Structure
- up
- down
### Running Migrations
- php artisan migrate
- php artisan migrate:status
- php artisan migrate --force
#### Rolling Back Migrations
- php artisan migrate:rollback
- php artisan migrate:rollback --step=5
- php artisan migrate:reset
- php artisan migrate:refresh
- php artisan migrate:refresh --seed
- php artisan migrate:refresh --step=5
- php artisan migrate:fresh
- php artisan migrate:fresh --seed
### Tables
#### Creating Tables
- Schema::create
- Schema::hasTable
- Schema::connection
- engine
- charset
- collation
- temporary
#### Updating Tables
- Blueprint
#### Renaming / Dropping Tables
- Schema::rename
- Schema::drop
- Schema::dropIfExists
### Columns
#### Creating Columns
#### Available Column Types
bigIncrements
bigInteger
binary
boolean
char
dateTimeTz
dateTime
date
decimal
double
enum
float
foreignId
geometryCollection
geometry
id
increments
integer
ipAddress
json
jsonb
lineString
longText
macAddress
mediumIncrements
mediumInteger
mediumText
morphs
multiLineString
multiPoint
multiPolygon
nullableMorphs
nullableTimestamps
nullableUuidMorphs
point
polygon
rememberToken
set
smallIncrements
smallInteger
softDeletesTz
softDeletes
string
text
timeTz
time
timestampTz
timestamp
timestampsTz
timestamps
tinyIncrements
tinyInteger
tinyText
unsignedBigInteger
unsignedDecimal
unsignedInteger
unsignedMediumInteger
unsignedSmallInteger
unsignedTinyInteger
uuidMorphs
uuid
year
#### Column Modifiers
- nullable
- after
#### Modifying Columns
- change
- renameColumn
#### Dropping Columns
- dropColumn
### Indexes
#### Creating Indexes
- unique
#### Renaming Indexes
- renameIndex
#### Dropping Indexes
- dropIndex
#### Foreign Key Constraints
- foreign
- foreignId
- constrained
- onUpdate
- onDelete
- dropForeign
- Schema::enableForeignKeyConstraints();
- Schema::disableForeignKeyConstraints();

## 6-5.Seeding
### Introduction
### Writing Seeders
- php artisan make:seeder UserSeeder
#### Using Model Factories
#### Calling Additional Seeders
### Running Seeders
- php artisan db:seed
- php artisan db:seed --class=UserSeeder
- php artisan migrate:fresh --seed
- php artisan db:seed --force

## 6-6.Redis
### Introduction
### Configuration
#### Clusters
#### Predis
#### phpredis
### Interacting With Redis
- Redis::get
- Redis::lrange(
- Redis::command
- Redis::connection
#### Transactions
- Redis::transaction
- Redis::eval
#### Pipelining Commands
- Redis::pipeline
### Pub / Sub
- Redis::subscribe
- Redis::publish
- Redis::psubscribe

# 7.Eloquent ORM
## 7-1.Getting Started
### Introduction
### Generating Model Classes
- php artisan make:model Flight
- php artisan make:model Flight --migration
- php artisan make:model Flight --factory
- php artisan make:model Flight -f
- php artisan make:model Flight --seed
- php artisan make:model Flight -s
- php artisan make:model Flight --controller
- php artisan make:model Flight -c
- php artisan make:model Flight -mfsc
- php artisan make:model Member --pivot
### Eloquent Model Conventions
#### Table Names
#### Primary Keys
#### Timestamps
#### Database Connections
#### Default Attribute Values
### Retrieving Models
- Flight::all
- fresh
- refresh
#### Collections
- reject
#### Chunking Results
- chunk
- chunkById
#### Streaming Results Lazily
- Flight::lazy
- lazyById
#### Cursors
- cursor
#### Advanced Subqueries
- select
- addSelect
- orderBy
### Retrieving Single Models / Aggregates
- find
- first
- firstWhere
- firstOr
- findOrFail
- firstOrFail
#### Retrieving Or Creating Models
- firstOrNew
- firstOrCreate
#### Retrieving Aggregates
- count
- sum
- max
### Inserting & Updating Models
#### Inserts
- save
- Flight::create
#### Updates
- update
- isDirty
- isClean
- wasChanged
- getOriginal
#### Mass Assignment
- fill
#### Upserts
- Flight::updateOrCreate
- Flight::upsert
### Deleting Models
- delete
- Flight::truncate
- Flight::destroy
#### Soft Deleting
- softDeletes
- dropSoftDeletes
- trashed
- restore
- withTrashed
- forceDelete
#### Querying Soft Deleted Models
- Flight::withTrashed
- Flight::onlyTrashed
### Replicating Models
- replicate
### Query Scopes
#### Global Scopes
- withoutGlobalScope
#### Local Scopes
### Comparing Models
- is
- isNot
### Events
#### Using Closures
- booted
#### Observers
- php artisan make:observer UserObserver --model=User
#### Muting Events

## 7-2.Relationships
### Introduction
### Defining Relationships
#### One To One
- hasOne
- belongsTo
#### One To Many
- hasMany
#### One To Many (Inverse) / Belongs To
- withDefault
#### Has One Through
- hasOneThrough
#### Has Many Through
- hasManyThrough
### Many To Many Relationships
- belongsToMany
#### Retrieving Intermediate Table Columns
- pivot
- withTimestamps
#### Filtering Queries Via Intermediate Table Columns
- wherePivot
- wherePivotIn
- wherePivotNotIn
#### Defining Custom Intermediate Table Models
- using
### Polymorphic Relationships
#### One To One
- morphTo
#### One To Many
#### Many To Many
- morphToMany
- morphedByMany
#### Custom Polymorphic Types
- morphMap
- Relation::getMorphedModel
### Dynamic Relationships
- resolveRelationUsing
### Querying Relations
- orWhere
#### Relationship Methods Vs. Dynamic Properties
#### Querying Relationship Existence
- has
- orHas
- whereHas
- orWhereHas
#### Querying Relationship Absence
- doesntHave
- orDoesntHave
- whereDoesntHave
- orWhereDoesntHave
#### Querying Morph To Relationships
- whereHasMorph
- whereDoesntHaveMorph
### Aggregating Related Models
#### Counting Related Models
- withCount
- loadCount
#### Other Aggregate Functions
- withSum
- loadSum
#### Counting Related Models On Morph To Relationships
- morphWithCount
- loadMorphCount
### Eager Loading
- with
- without
#### Constraining Eager Loads
- constrain
#### Lazy Eager Loading
- load
- loadMissing
### Inserting & Updating Related Models
#### The save Method
- save
- saveMany
- refresh
- push
#### The create Method
- create
- createMany
#### Belongs To Relationships
- associate
#### Many To Many Relationships
- attach
- detach
- sync
- toggle
- updateExistingPivot
### Touching Parent Timestamps

## 7-3.Collections
### Introduction
### Available Methods
contains
diff
except
find
fresh
intersect
load
loadMissing
modelKeys
makeVisible
makeHidden
only
toQuery
unique
### Custom Collections

## 7-4.Mutators / Casts
### Introduction
### Accessors & Mutators
#### Defining An Accessor
- get{Attribute}Attribute
#### Defining A Mutator
- set{Attribute}Attribute
### Attribute Casting
#### Array & JSON Casting
#### Date Casting
#### Query Time Casting
### Custom Casts
#### Value Object Casting
#### Array / JSON Serialization
- serialize
#### Inbound Casting
#### Cast Parameters
#### Castables

## 7-5.API Resources
### Introduction
### Generating Resources
- php artisan make:resource UserResource
- php artisan make:resource User --collection
- php artisan make:resource UserCollection
### Concept Overview
- toArray
#### Resource Collections
- collection
- php artisan make:resource UserCollection
### Writing Resources
- collection
#### Data Wrapping
#### Pagination
#### Conditional Attributes
- mergeWhen
#### Conditional Relationships
- whenLoaded
- whenPivotLoaded
- whenPivotLoadedAs
#### Adding Meta Data
- additional
### Resource Responses
- response
- withResponse

## 7-6.Serialization
### Introduction
### Serializing Models & Collections
#### Serializing To Arrays
- attributesToArray
#### Serializing To JSON
- toJson
### Hiding Attributes From JSON
- makeVisible
- makeHidden
### Appending Values To JSON
- append
### Date Serialization
- serializeDate

# 8.Testing
## 8-1.Getting Started
### Introduction
### Environment
- .env.testing
### Creating Tests
- php artisan make:test UserTest
- php artisan make:test UserTest --unit
### Running Tests
- vendor/bin/phpunit
- php artisan test
- php artisan test --testsuite=Feature --stop-on-failure
#### Running Tests In Parallel
- php artisan test --parallel
- php artisan test --parallel --processes=4
- php artisan test --parallel --recreate-databases

## 8-2.HTTP Tests
### Introduction
### Making Requests
#### Customizing Request Headers
- withHeaders
#### Cookies
- withCookie
- withCookies
#### Session / Authentication
- withSession
- actingAs
- actingAs
#### Debugging Responses
- dump
- dumpHeaders
- dumpSession
### Testing JSON APIs
- json
- getJson
- postJson
- putJson
- patchJson
- deleteJson
- optionsJson
- assertJson
- assertJsonPath
#### Fluent JSON Testing
- etc
- whereType
- whereAllType
### Testing File Uploads
- Storage::fake
- assertMissing
### Testing Views
- assertSee
- assertSeeInOrder
- assertSeeText
- assertSeeTextInOrder
- assertDontSee
- assertDontSeeText
- withViewErrors
#### Rendering Blade & Components
- blade
- component
### Available Assertions
#### Response Assertions
assertCookie
assertCookieExpired
assertCookieNotExpired
assertCookieMissing
assertCreated
assertDontSee
assertDontSeeText
assertExactJson
assertForbidden
assertHeader
assertHeaderMissing
assertJson
assertJsonCount
assertJsonFragment
assertJsonMissing
assertJsonMissingExact
assertJsonMissingValidationErrors
assertJsonPath
assertJsonStructure
assertJsonValidationErrors
assertLocation
assertNoContent
assertNotFound
assertOk
assertPlainCookie
assertRedirect
assertSee
assertSeeInOrder
assertSeeText
assertSeeTextInOrder
assertSessionHas
assertSessionHasInput
assertSessionHasAll
assertSessionHasErrors
assertSessionHasErrorsIn
assertSessionHasNoErrors
assertSessionDoesntHaveErrors
assertSessionMissing
assertStatus
assertSuccessful
assertUnauthorized
assertViewHas
assertViewHasAll
assertViewIs
assertViewMissing
#### Authentication Assertions
- assertAuthenticated
- assertGuest
- assertAuthenticatedAs

## 8-3.Console Tests
### Introduction
### Input / Output Expectations
- expectsQuestion
- assertExitCode
- expectsOutput
- doesntExpectOutput
- expectsConfirmation
- expectsTable

## 8-4.Browser Tests(Laravel Dusk)
### Introduction
### Installation
#### Managing ChromeDriver Installations
#### Using Other Browsers
### Getting Started
#### Generating Tests
- php artisan dusk:make LoginTest
#### Database Migrations
#### Running Tests
- php artisan dusk
- php artisan dusk:fails
- php artisan dusk --group=foo
- driver
#### Environment Handling
### Browser Basics
#### Creating Browsers
- browse
#### Navigation
- visit
- back
- forward
- refresh
#### Resizing Browser Windows
- resize
- maximize
- fitContent
- disableFitOnFailure
- move
#### Browser Macros
- macro
- boot
#### Authentication
- loginAs
#### Cookies
- cookie
- plainCookie
- deleteCookie
#### Executing JavaScript
- script
#### Taking A Screenshot
- screenshot
#### Storing Console Output To Disk
- storeConsoleLog
#### Storing Page Source To Disk
- storeSource
### Interacting With Elements
#### Dusk Selectors
#### Text, Values, & Attributes
- value
- inputValue
- text
- attribute
#### Interacting With Forms
- type
- clear
- typeSlowly
- appendSlowly
- select
- check
- uncheck
- radio
#### Attaching Files
- attach
#### Pressing Buttons
- press
- pressAndWaitFor
#### Clicking Links
- clickLink
- seeLink
#### Using The Keyboard
- keys
- type
#### Using The Mouse
- click
- clickAtXPath
- clickAtPoint
- doubleClick
- rightClick
- clickAndHold
- releaseMouse
- mouseover
- drag
- dragLeft
- dragRight
- dragUp
- dragDown
- dragOffset
#### JavaScript Dialogs
- waitForDialog
- assertDialogOpened
- typeInDialog
- acceptDialog
- dismissDialog
#### Scoping Selectors
- with
- elsewhere
- elsewhereWhenAvailable
#### Waiting For Elements
- pause
- waitFor
- waitForTextIn
- waitUntilMissing
- whenAvailable
- waitForText
- waitUntilMissingText
- waitForLink
- waitForLocation
- waitForRoute
- waitForReload
- waitUntil
- waitUntilVue
- waitUntilVueIsNot
- waitUsing
- waitUsing
#### Scrolling An Element Into View
- scrollIntoView
### Available Assertions
assertTitle
assertTitleContains
assertUrlIs
assertSchemeIs
assertSchemeIsNot
assertHostIs
assertHostIsNot
assertPortIs
assertPortIsNot
assertPathBeginsWith
assertPathIs
assertPathIsNot
assertRouteIs
assertQueryStringHas
assertQueryStringMissing
assertFragmentIs
assertFragmentBeginsWith
assertFragmentIsNot
assertHasCookie
assertHasPlainCookie
assertCookieMissing
assertPlainCookieMissing
assertCookieValue
assertPlainCookieValue
assertSee
assertDontSee
assertSeeIn
assertDontSeeIn
assertSeeAnythingIn
assertSeeNothingIn
assertScript
assertSourceHas
assertSourceMissing
assertSeeLink
assertDontSeeLink
assertInputValue
assertInputValueIsNot
assertChecked
assertNotChecked
assertRadioSelected
assertRadioNotSelected
assertSelected
assertNotSelected
assertSelectHasOptions
assertSelectMissingOptions
assertSelectHasOption
assertSelectMissingOption
assertValue
assertAttribute
assertAriaAttribute
assertDataAttribute
assertVisible
assertPresent
assertNotPresent
assertMissing
assertDialogOpened
assertEnabled
assertDisabled
assertButtonEnabled
assertButtonDisabled
assertFocused
assertNotFocused
assertAuthenticated
assertGuest
assertAuthenticatedAs
assertVue
assertVueIsNot
assertVueContains
assertVueDoesNotContain
### Pages
#### Generating Pages
- php artisan dusk:page Login
#### Configuring Pages
- url
- assert
- elements
#### Navigating To Pages
- visit
- on
#### Shorthand Selectors
- elements
- siteElements
#### Page Methods
- createPlaylist
### Components
#### Generating Components
- php artisan dusk:component DatePicker
#### Using Components
### Continuous Integration
#### Heroku CI
#### Travis CI
#### GitHub Actions

## 8-5.Database
### Introduction
#### Resetting The Database After Each Test
### Defining Model Factories
#### Concept Overview
- database/factories/UserFactory.php
#### Generating Factories
- php artisan make:factory PostFactory
- php artisan make:factory PostFactory --model=Post
#### Factory States
- state
#### Factory Callbacks
- afterMaking
- afterCreating
- configure
### Creating Models Using Factories
#### Instantiating Models
- factory
- make
- state
- newFactory
#### Persisting Models
- create
- save
#### Sequences
- admin
### Factory Relationships
#### Has Many Relationships
- has
- posts
- hasPosts
#### Belongs To Relationships
- for
- forUser
#### Many To Many Relationships
- hasAttached
#### Polymorphic Relationships
- morphToMany
- morphedByMany
#### Defining Relationships Within Factories
- belongsTo
- morphTo
### Running Seeders
- seed
### Available Assertions
- assertDatabaseCount
- assertDatabaseHas
- assertDatabaseMissing
- assertDeleted
- assertSoftDeleted

## 8-6.Mocking
### Introduction
### Mocking Objects
- mock
- partialMock
- Mockery::spy 
### Mocking Facades
- Cache::shouldReceive
#### Facade Spies
- Cache::spy
### Bus Fake
- Bus::fake
- assertDispatched
- assertNotDispatched
#### Job Chains
- Bus::assertChained
#### Job Batches
- Bus::assertBatched
### Event Fake
- Event::fake
- Event::assertDispatched
- Event::assertNotDispatched
- Event::assertNothingDispatched
- Event::assertListening
- fake
- fakeFor
#### Scoped Event Fakes
### HTTP Fake
### Mail Fake
- Mail::fake
- Mail::assertNothingSent
- Mail::assertSent
- Mail::assertNotSent
- Mail::assertQueued
- Mail::assertNotQueued
- Mail::assertNothingQueued
- assertSent
- assertNotSent
### Notification Fake
- Notification::fake
- Notification::assertNothingSent
- Notification::assertSentTo
- Notification::assertNotSentTo
### Queue Fake
- Queue::fake
- Queue::assertNothingPushed
- Queue::assertPushedOn
- Queue::assertPushed
- Queue::assertNotPushed
- assertPushed
- assertNotPushed
#### Job Chains
- Queue::assertPushedWithChain
- assertPushedWithoutChain
### Storage Fake
- Storage::fake
- Storage::disk('photos')->assertExists('photo1.jpg');
- Storage::disk('photos')->assertExists(['photo1.jpg', 'photo2.jpg']);
- Storage::disk('photos')->assertMissing('missing.jpg');
- Storage::disk('photos')->assertMissing(['missing.jpg', 'non-existing.jpg']);
    }
}
### Interacting With Time
- $this->travel(5)->milliseconds();
- $this->travel(5)->seconds();
- $this->travel(5)->minutes();
- $this->travel(5)->hours();
- $this->travel(5)->days();
- $this->travel(5)->weeks();
- $this->travel(5)->years();
- $this->travel(-5)->hours();
- $this->travelTo(now()->subHours(6));
- $this->travelBack();

# 9.Packages
## 9-1.環境構築
### Homestead
開発環境構築ツール。
Vagrantを利用して仮想マシーンを簡単に構築できる。

### Sail
Docker 開発環境構築ツール。
PHP、MySQL、Redisを使用してLaravelアプリケーションを構築するための優れた出発点。
Laradockよりも軽量かつ公式なので安心？

### Valet
簡便な環境構築ツール。
Nginx や Dnsmasq などのソフトウェアを組み合わせたライブラリ。
Homesteadと違い、ローカル環境に仮想サーバーを構築する。
Homesteadより軽量で設定が楽。

## 9-2.認証
### Breeze
下記の特徴を持つスターターキット。Laravel Jetstreamよりもシンプル。
- login
- registration
- password reset
- email verification
- password confirmation
- Blade templates
- Tailwind CSS

### Jetstream
下記の特徴を持つスターターキット。Laravel Breezeより本格的。
- login
- registration
- password reset
- email verification
- two-factor authentication
- password confirmation
- session management
- Blade templates
- Tailwind CSS
- Livewire or Inertia

### Fortify
Jetstreamの認証機能部分を取り出したパッケージ。
ログイン、ユーザ登録画面を自分で作成する必要がある。
- login
- registration
- password reset
- email verification

### Passport
APIにOAuthに従った認証機能を追加できるツール。
(OAuthを発行する際に必要)

### Sanctum
トークンベースの認証システム構築のためのツール。
Laravel Passportに似ているが、SanctumはSPA開発に向いている。

### Socialite
ソーシャルログイン機能(OAuth認証)を実装するためのツール
(発行されたOAuthを使ってログインする際に必要)

## 9-3.決済
### Cashier (Stripe)
Stripe(決済プラットフォーム)のサブスクリプション決済と連携するためのツール。
- coupons
- swapping subscription
- subscription "quantities"
- cancellation grace periods
- even generate invoice PDFs

### Cashier (Paddle)
Paddle(決済プラットフォーム)のサブスクリプション決済と連携するためのツール。
- coupons
- swapping subscription
- subscription "quantities"
- cancellation grace periods

## 9-4.検索
### Scout
Eloquentモデルに全文検索機能を追加するツール。

## 9-5.テスト
### Dusk
テストAPIを提供するツール。
ブラウザテストを自動化できる。

### Telescope
ローカル開発環境でデバッグを釣るためのツール。

## 9-6.デプロイ
### Envoy
リモートサーバーでデプロイするためのツール。
指定したサーバにsshで接続して、コマンドを打ち込むなどの手作業を自動的にコマンド１発でやってくれる。

## 9-7.運用
### Horizon
Redisキューのためのダッシュボード。
本番運用用のモニタリングツール。
