<?php

	$route['sample'] = [
							false, // specify the default template name, if declared an controller, this will not be read
							'sample_controller@sample', // controller name, the '@' symbol is a delimiter between your controller name and the method e.g controller@method, if no method, index will be use by default
							false // models, provide an array if multiple e.g. ['model1','model2','model3']. If false, all models in the models folder will be loaded
						];

	$route['ajax'] = [false,'sample_controller@ajax',false];