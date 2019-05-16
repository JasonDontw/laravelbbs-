## About LaraBBS
LaraBBS is a simple forum application writen with Laravel. It's a practice learn from <br>[L02 Laravel 教程 - Web 开发实战进阶](https://learnku.com/courses/laravel-intermediate-training/5.8)<br>
[L03 Laravel 教程 - 实战构架 API 服务器](https://learnku.com/courses/laravel-advance-training/5.8)

![alt demo](./larabbs-demo.gif)


## Feature
- User authentication —— Register、Login、Logout
- Profile
- Upload images
- Multiple role manage
- Notification
- Custom Artisan command

## Build/Set up
The enviroment is [Laravel Homestead](https://laravel.com/docs/5.8/homestead).
The following description will be made assuming user has already installed homestead.

**1. Clone the source code**
```
> git clone git@github.com:yan8909/larabbs.git
```

**2. Set up Homestead**

1). run the commend to edit Homestead.yaml
```
> homestead edit
```
2). edit Homestead.yaml
```
folders:
    - map: ~/my-path/larabbs/ # your project path
      to: /home/vagrant/larabbs

sites:
    - map: larabbs.test
      to: /home/vagrant/larabbs/public

databases:
    - larabbs
```
3). apply chandes
```
> homestead provision
> homestead reload
```

**3. Install composer**
```
> composer install
```

**4. Generate .env file**
```
> cp .env.example .env
```

**5. Generate key**
```
> php artisan key:generate
```

**6. Migration**
```
php artisan migrate --seed
```

**7. Set up hosts file**
```
echo "192.168.10.10   phphub.app" | sudo tee -a /etc/hosts
```

## Front-end set up
1. install [node.js](https://nodejs.org/en/)
2. install [Yarn](https://yarnpkg.com)
3. install Laravel Mix
```
yarn install
```
4. running Mix
```
// run all Mix task...
npm run dev

// Run all Mix tasks and minify output...
npm run production
```
5. watching assets for changes
```
npm run watch
```
You may find that in certain environments Webpack isn't updating when your files change. If this is the case on your system, consider using the watch-poll command:
```
npm run watch-poll
```

## Links
- Homepage : http://larabbs.test/
- Admin : http://larabbs.test/admin
admin account and password:
```
username: admin@test.com
password: password
```

## Used package
- [Intervention/image](https://github.com/Intervention/image)
- [predis/predis](https://github.com/nrk/predis.git)
- [spatie/laravel-permission](https://github.com/spatie/laravel-permission)
- [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)
- [mewebstudio/Purifier](https://github.com/mewebstudio/Purifier)
- [hieu-le/active](https://github.com/letrunghieu/active)
- [summerblue/administrator](https://github.com/summerblue/administrator)
- [viacreative/sudo-su](https://github.com/viacreative/sudo-su)
- [laravel/horizon](https://github.com/laravel/horizon)

## Custom Artisan command
**Calculate active user :**
```
larabbs:calculate-active-user
```

**Record user's last active time to datebase from Redis**
```
larabbs:sync-user-actived-at
```
