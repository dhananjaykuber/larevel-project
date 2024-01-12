## Laravel 10

#### vendor --> like node modules folder for composer

#### phpunit --> used to write the test cases for the laravel

## Database

-   Running SQL queries
-   Query Builder
-   Eloquent

## Mutator & Accessor

-   Mutator: transforms the value of attribute when it is set
-   Accessor: transforms the value of attrubute when we get it from table

### Database queries

```
    // get users
    // $users = DB::select('select * from users');
    // $users = DB::table('users')->get();
    // $users = User::find(23);

    // create new user
    // $user = DB::insert('insert into users (name, email, password) values (?, ?, ?)', ['New Name', 'new@gmail.com', "12345678"]);
    // $user = DB::table('users')->insert([
    //     "name" => "Bhau Kadam",
    //     "email" => "bhau2@gmail.com",
    //     "password" => "12345678"
    // ]);
    // $user = User::create([
    //     "name" => "new devs",
    //     "email" => "navababa@gmail.com",
    //     "password" => "12345678"
    // ]);

    // update user
    // $user = DB::update('update users set email=? where id=?', ['john.doe@gmail.com', 2]);
    // $user = DB::table('users')->where('id', 5)->update(['name' => 'sandeep', 'email' => 'sandeep@laravel.com']);
    // $user = User::find(7);
    // $user->update(['name' => 'Namo Dev', 'email' => 'namo.deva@gmail.com']);

    // delete user
    // $user = DB::delete('delete from users where id = ?', [2]);
    // $user = DB::table('users')->where('id', 3)->delete();
    // $user = User::find(7);
    // $user->delete();

    // $users = User::all();

    // dd($users->name);
```

## Config cache

-   reading configurations from file all the times is not optimal, so we cache the config and it is stored in bootstrap/cache/config.php
-   when we change any file in config or env file then we to run the command `php artisan config:cache`

## DB table changes

-   when we wanted to make the changes in table then first we make migrations using `php artisan make:migration update_user_table_add_avatar_field --table=users`, here we provide the name to the migration name and the table name
-   and after successful migration we make the changes into that migration file
-   at end we run `php artisan migrate` command to run the migrations

## Laravel Shell

-   `php artisan tinker`

## Mass Assignment

-   in $fillable array of model fields: https://laravel.com/docs/10.x/eloquent#mass-assignment

## Controllers

-   php artisan make:controller Profile/AvatarController

## Redirects

```
return response()->redirectTo('/profile');
                    OR
return response()->redirectTo(route('profile.edit'));
                    OR
return back()->with('message', 'Avatar is updated');
```

## Request Validation

`php artisan make:request UpdateAvatarRequest`

## Current user

-`auth()->user()`

## Link storage with public

-   `php artisan storage:link`
