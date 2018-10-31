# j-framework
Lite MVC PHP app framework


#### Routes

Here you can define your route

Example

```
$route['sample'] = [
	false, // specify the default template name, if declared an controller, this will not be read
	'sample_controller@sample', // controller name, the '@' symbol is a delimiter between your controller name and the method e.g controller@method, if no method, index will be use by default
	false // models, provide an array if multiple e.g. ['model1','model2','model3']. If false, all models in the models folder will be loaded
];

```

Refer to routes.php 


#### Controller

All controllers must be put in 'controllers' folder. See 'controllers/Sample_controller.php' sample.


#### Model

All models must be put in 'models folder'. See 'models/Sample_model.php' sample

Example
```
//initialize model

use App\Models\ModelName as model


```

and then initialize it by

```
$model = new ModelName();

```

to your controller;

### View

All templates or anything that was tied up with the view must be put on 'templates' folder.

you can directly call the view by not specifying a controller name unto a route. If controller was declared then the view name will be skip

```
$route['home'] = [home_template] // this can be found inside the templates folder
```

### Config

(config.php) here you can put all the configurations for you app. Some of the default and required settings are

```
$app['url'] = ''; // leave this empty if app is not hosted on shared hosting
$app['title'] = '' // specify your app title
$app['db']['mysql'] = [..]; // database settings
```

### External Recommended Packages
For input validations
https://respect-validation.readthedocs.io/en/1.1/
```
use \Respect\Validation\Validator as v;
```
For database wrapper
https://github.com/ThingEngineer/PHP-MySQLi-Database-Class
```
use \MysqliDb as sqldb;
```
for php mailer
https://github.com/PHPMailer/PHPMailer
```
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
```
