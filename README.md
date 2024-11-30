# Laravel RolePermission Package

This package provides RolePermission for Laravel applications.

## Installation

To install the package, use Composer:

```bash
composer require mdnayeemsarker/role-permission
```

## Service Provider Registration
In your Laravel project’s config/app.php, add the RolePermissionServiceProvider to the providers array if it’s not already there:
```bash
    'providers' => [
        // Other service providers...
        Mdnayeemsarker\RolePermission\MnsRpServiceProvider::class,
    ],
```

## Publishes Method
```bash
    php artisan vendor:publish --provider="Mdnayeemsarker\RolePermission\MnsRpServiceProvider"
```

## Clear Cache & Autoload Files Again
```bash
    php artisan config:clear
    php artisan cache:clear
    composer dump-autoload
```

## Migrate 
```bash
    php artisan migrate
```

## For testing make prepare db seder or input some dummey data.
* for db seder make RolePermissionsTableSeeder
public function run(): void
{
```bash
    // Create some dummy roles
    Role::create(['name' => 'admin']);
    Role::create(['name' => 'editor']);
    Role::create(['name' => 'user']);

    // Create some dummy permissions
    Permission::create(['name' => 'view-dashboard', 'section' => 'admin']);
    Permission::create(['name' => 'edit-articles', 'section' => 'editor']);
    Permission::create(['name' => 'view-articles', 'section' => 'user']);
    Permission::create(['name' => 'delete-articles', 'section' => 'admin']);

    // Create some dummy role permission
    RolePermission::create(['role_id' => '1', 'permission_id' => '1']);
    RolePermission::create(['role_id' => '1', 'permission_id' => '4']);
```
}

```bash
    php artisan db:seed
```

## Update User.php in (App\Models)
```bash
    // Define the relationship with Role (Override)
    public function role()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }
    // Define the relationship with Permissions
    public function allPermissions()
    {
        return $this->role->flatMap->permissions;
    }
```

## Assign user role
Go to your controller
```bash
    $user = Auth::user();
    $role = Role::find(1); // Find the role you want to assign
    $user->role()->attach($role); // Assign the role
```

## Check user all permission
```bash
    $user = Auth::user();
    if ($user && $user->role()->exists()) {
        dd($user->allPermissions()); // this retuens user all permission
    } else {
        dd('User has not any permission'); // set some permission accrose user and check 
    }
```

## Check User all permission with permission name
```bash
    $user = Auth::user();
    if ($user && $user->role()->exists()) {
        $permissions = $user->allPermissions();
        $permissionNames = $permissions->pluck('name');
        dd([$permissions, $permissionNames]); // Debugging
    } else {
        $permissions = [];
        dd($permissions); // Debugging
    }
```

## Getting To Know Yeoman

* Feel free to [learn more about MD NAYEEM SARKER](https://github.com/mdnayeemsarker).


## License

MIT © [MD NAYEEM SARKER](https://github.com/mdnayeemsarker)