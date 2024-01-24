
# Discuss

Simple forum based on Github Discussions built with the [TALL stack](https://tallstack.dev)

![discuss forum](https://github.com/Golveira/discuss/assets/30783517/f51ef37a-7a69-4961-bef5-9e8400a6ee27)


## Features

* Dark mode
* Markdown editor
* Likes and Replies
* Best answer
* Search threads
* Filter and sort threads
* Profile
* Users with most answers rank
* Thread subscription system
* Real time notification system
* Moderation system
    * ban users
    * edit / delete threads
    * open / close threads
    * pin / unpin threads
      
## Install
1. `git clone https://github.com/Golveira/discuss.git`
2. `composer install`
3. `cp .env.example .env`
4. `php artisan key:generate`
5. `php artisan migrate:refresh --seed`
6. `npm install && npm run dev`
7. `php artisan serve`
