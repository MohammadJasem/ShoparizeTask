Dear User

To run this project, first please run "<b>composer install</b>"

To run the project you have to use apache server

You can enter the project using this url "http://localhost/ShoparizeTask/api/"

To use sum API in the right way you have to use this url "http://localhost/ShoparizeTask/api/sum"

It must be post request. Body parameters must be the following

1. distance1Unit: it refers to the first distance unit and must be "y" or "m". it doesn't matter if it's uppercase or lowercase

2. distance2Unit: it refers to the second distance unit and must be "y" or "m". it doesn't matter if it's uppercase or lowercase

3. resultUnit: it refers to the second result unit and must be "y" or "m". it doesn't matter if it's uppercase or lowercase

4. distance1Val: it refers to the first distance value and it must be positive number(float or integer) and it can be zero too

5. distance2Val: it refers to the second distance value and it must be positive number(float or integer) and it can be zero too

All parameters are required

The API is online. You can check it here: https://scandiweb-tests.000webhostapp.com/ShoparizeTask/api

Request class contain just one function to get parameters array if the request method is post or get

MainController contain sum function

api/index file contains the available APIs and run them and return 404 if API is not exist

api class contains 3 functions

1. post function: it's for API's post requests and run the right function in the right controller

2. get function: it's for API's get requests and run the right function in the right controller

3. notFound_404 function: return 404 response

APIRespose class contains functions for response sending request

Thanks
