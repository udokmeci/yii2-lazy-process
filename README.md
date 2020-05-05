Yii2 Lazy Process
=================
This extensions mimics a queue to run after sending response.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist udokmeci/yii2-lazy-process "*"
```

or add

```
"udokmeci/yii2-lazy-process": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, attach behaviour to your reponse in config like :

```php
...
	'response'=>[
		...
        'as queueRunner'=>'udokmeci\lazy\QueueRunnerBehavior'
    ],
...
```