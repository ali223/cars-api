I have developed this demo using Laravel framework 5.4 and have also deployed the API at http://cars-api-app.herokuapp.com/api/carmodels

And I have also developed a Front-end to send AJAX requests to the API using Vue.js, which can be accessed at http://cars-api-app.herokuapp.com

When you hit the endpoint http://cars-api-app.herokuapp.com/api/carmodels with a GET request, it will return a list of all the Models and related Cars in JSON format.

Using the GET request, you can pass parameters in the query string to apply various filters. The query string parameters that you can use to apply filters are fueltype, transmission, maxprice, minprice, owners, minmileage, maxmileage and these are case sensitive, so should be all lower case. The values you supply for these parameters are not case-sensitive. You can apply more than one filters at the same time, and the results will be filtered accordingly.

For example, to get JSON data for all the cars which have a manual transmission and also the maximum mileage of 50000 miles, you can use the following url:-

http://cars-api-app.herokuapp.com/api/carmodels?maxmileage=50000&transmission=manual

Similarly, to get JSON data for all petrol cars between the price of 5000 and 15000, you can use the following url:-

http://cars-api-app.herokuapp.com/api/carmodels?minprice=5000&maxprice=15000&fueltype=petrol