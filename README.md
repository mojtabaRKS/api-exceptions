# Laravel / lumen api exceptions handler

a lightweight package for create and pass response for use in laravel || lumen

### Prerequisites

before start, you should have personal access token and SSH key.

* [how to create SSH-key](https://docs.gitlab.com/ee/ssh/README.html#generating-a-new-ssh-key-pair)
* [how to create personal access token](https://docs.gitlab.com/ee/user/profile/personal_access_tokens.html#creating-a-personal-access-token)

next you should add your personal access token to composer

```
$ composer config \
  --auth gitlab-token.gitlab.com "YOUR-TOKEN-HERE" \
  --no-ansi \
  --no-interaction
```

If you prefer to do this manually, create ~/.composer/auth.json, with the following content:
```
{
  "gitlab-token": {
    "gitlab.com": "YOUR-TOKEN-HERE"
  }
}
```

### Installation

easily copy below code and paste in your `composer.json`

```
"repositories": {
        "liateam/api-exceptions" : {
            "type": "vcs",
            "url": "git@git.liateam.net:php/packages/api-exceptions.git"
        }
    },
```

easily copy below code and paste in your `composer.json` -> `require` section

```
"liateam/api-exceptions": "^2.0"
```

run the command below in your project :

```
$ composer update
```

### lumen specific installation
if your project is lumen so you should copy `Liateam/api-exceptions/src/config/exceptions` to your `config` directory !
*NOTE* : If you don't have `config` directory so create it !

then add below code in your `bootstrap/app.php` :
```
  $app->configure(exceptions);
```

### laravel specific installation
```
$ php artisan vendor:publish --config="Liateam/api-exceptions/src/config/exceptions.php"
```


## Usage

overwrite `render` method of `App\Exceptions\Handler` like this : 
```
    use Liateam\ApiExceptions\Handlers\ApiException;
  
    public function render($request, Throwable $exception)
    {
        return ApiException::handle($exception)->render();
    }
```

## Authors

* **Mojtaba Rakhisi** - *Initial work* - [github](https://github.com/mojtabarks)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
