app.factory('getFlightDataService', function ($q, $http) { 
   
  var service = {}; 
  service.getFlights = getFlightsC; 
  service.sendFile = sendFileC;
 
  return service; 
  function getFlightsC(url,data) {  console.log("service called");
    // We make use of Angular's $q library to create the deferred instance 
    console.log("data sending"); console.log(data);
    var deferred = $q.defer();
    var headers = { 
        'Access-Control-Allow-Origin' : '*', 
        'Access-Control-Allow-Methods' : 'POST, GET, OPTIONS, PUT', 
        'Content-Type' : 'application/x-www-form-urlencoded', 
        'Accept': 'application/json' 
      }; 
//JSON.stringify(data), field_videourl[und][0][value]  postData = {origin:$scope.origin,destination:$scope.destination,departureDate:$scope.departureDate,lengthofstay:$scope.lengthofstay}; 
//data: {type:data.type,title:data.title,body:data.body,email:data.email,fileurl:data.fileurl,apikey:data.apikey}, 
    $http({ 
            method: 'POST', 
            url: url,
            cache: false, 
            data: "origin="+data.origin+"&destination="+data.destination+"&departureDate="+data.departureDate+"&returndate="+data.returndate+"&lengthofstay="+data.lengthofstay+"&limit="+data.limit, 
            headers: headers 
        }) 
        .success(function(data) { 
          // The promise is resolved once the HTTP call is successful. 
          //console.log(data);
          deferred.resolve(data); 
        }) 
        .error(function() { 
          // The promise is rejected if there is an error with the HTTP call. 
          deferred.reject(); 
        }); 

    // The promise is returned to the caller 
    return deferred.promise; 
  } 

  function sendFileC(url,data) { 
    // We make use of Angular's $q library to create the deferred instance 
    var deferred = $q.defer(); 
    var headers = { 
        'Access-Control-Allow-Origin' : '*', 
        'Access-Control-Allow-Methods' : 'POST, GET, OPTIONS, PUT', 
        'Content-Type' : 'application/json', 
        'Accept': 'application/json' 
      }; 
//JSON.stringify(data), 
//data: {type:data.type,title:data.title,body:data.body,email:data.email,fileurl:data.fileurl,apikey:data.apikey}, 
    $http({ 
            method: 'POST', 
            url: url, 
            data: {filedata:data.imgdata}, 
            headers: headers 
        }) 
        .success(function(data) { 
          // The promise is resolved once the HTTP call is successful. 
          deferred.resolve(data); 
        }) 
        .error(function() { 
          // The promise is rejected if there is an error with the HTTP call. 
          deferred.reject(); 
        }); 

    // The promise is returned to the caller 
    return deferred.promise; 
  } 


}); 


app.filter('split', function() {
        return function(input, splitChar, splitIndex) {
            // do some bounds checking here to ensure it has that index
            return input.split(splitChar)[splitIndex];
        }
});