# j-framework
Lite MVC PHP app framework


#### Routes

Here you can define your route

Example
```
$app->route( [ http request e.g home, about, projects/my-projects] ,[controller and its class to be initialize separated by 'a', e.g. index@testController ]);

```

Refer to routes.php 

You may specify 'controller' argument to false to directly bind a view
```
$app->route('about',false,'index');
```

#### Controller

All controllers must be put in 'core/controllers' folder. See testController.php sample.


#### Model

All models must be put in 'core/models folder'. See testModel.php sample

Example
```
//initialize model

use App\Models\ModelName as model


```

and then initialize it by

```
$model = new ModelName();

```

### View

all files that are used on redering your app must be put in 'app' folder

### Config

resides in 'app/config.php' here you can put all the configurations for you app. If you intend to run this in a shared hosting, you may specify the absolute url of the framework in the '$app_url'.
