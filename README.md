# Laravel Modules QwShop

this library is one of [qingwuit/qwshop](https://gitee.com/allendebug/qwshop) **laravel-modules** module.

## Introduction

The Laravel Modules QwShop overwrite "qingwuit/qwshop" routes, resources, or others files.

With help of package [allenwakeup/laravel-modules](https://github.com/allenwakeup/laravel-modules),
    there is an opportunity that makes qwshop in modules.
    
## Installation

To install through Composer, by run the following command:

```shell script
composer require goodcatch/laravel-modules-qwshop
```

### migration

```shell script
php artisan goodcatch:table

php artisan migrate

php artisan goodcatch:cache
```


### publish files

just following commands.

```shell script
php artisan vendor:publish --tag=goodcatch-modules-qwshop
```

**note:** make qwshop project clean and then publish files.


### node

build front-end

```shell script
yarn run prod
```

or


```shell script
yarn run dev
```

