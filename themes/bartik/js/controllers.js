app.service('flightServiceNew', function($http, $q) {
      

      return {
        loadDataFromUrls: function(urls,data) {

          var nonstop = false;

          var headers = { 
            'Access-Control-Allow-Origin' : '*', 
            'Access-Control-Allow-Methods' : 'POST, GET, OPTIONS, PUT', 
            'Content-Type' : 'application/x-www-form-urlencoded', 
            'Accept': 'application/json' 
          }; 
         
          if(data.outboundflightstops != "" && data.outboundflightstops == 0){
            nonstop = true;
          }

          var arrivebyval = "";

          if(data.outbounddeparturewindow != ""){
            var str = data.outbounddeparturewindow;
            str = str.substr(str.length - 4); 
            var a = str;
            var b = ":";
            var position = 2;
            var output = [a.slice(0, position), b, a.slice(position)].join('');
            //console.log(output);
            arrivebyval = data.departureDate +"T"+ output;
          }

          var returnbyval = "";

          if(data.outbounddeparturewindow != ""){
            var str = data.outbounddeparturewindow;
            str = str.substr(str.length - 4); 
            var a = str;
            var b = ":";
            var position = 2;
            var output = [a.slice(0, position), b, a.slice(position)].join('');
            //console.log(output);
            returnbyval = data.returndate +"T"+ output;
          }

          //var urlamadeus = ="+data.origin+"&destination="+data.destination+"&departure_date="+data.departureDate;

          var urlamadeus = "origin="+data.origin+"&destination="+data.destination+"&departure_date="+data.departureDate;
          
          if(data.returndate != ""){
            urlamadeus = urlamadeus +"&return_date="+data.returndate;
          }

          if(data.limit != ""){
            urlamadeus = urlamadeus +"&number_of_results="+data.limit;
          }

          if(nonstop != ""){
            urlamadeus = urlamadeus +"&nonstop="+nonstop;
          }

          if(arrivebyval != ""){
            urlamadeus = urlamadeus +"&arrive_by="+arrivebyval;
          }

          if(data.includedcarriers != ""){
            urlamadeus = urlamadeus +"&include_airlines="+data.includedcarriers;
          }

          if(data.adult != 0){
            urlamadeus = urlamadeus +"&adults="+data.adult;
          }

          if(data.children != 0){
            urlamadeus = urlamadeus +"&children="+data.children;
          }
          
        
          //,adult:$scope.adult,children:$scope.children,infant:$scope.infant

          var deferred = $q.defer();
          var urlCalls = [];
          var urlsnew = [];
          urlsnew.push(urls);
          //urls = urls.replace("fs/","");
          //urls = urls + "amadeusurl";
          //urlsnew.push(urls);
          var counter = 1;
          angular.forEach(urlsnew, function(url) {

            if(counter == 1){

              urlCalls.push($http({ 
                  method: 'POST', 
                  url: url,
                  cache: false, 
                  data: "origin="+data.origin+"&destination="+data.destination+"&departureDate="+data.departureDate+"&returndate="+data.returndate+"&lengthofstay="+data.lengthofstay+"&limit="+data.limit+"&outboundflightstops="+data.outboundflightstops+"&outbounddeparturewindow="+data.outbounddeparturewindow+"&includedcarriers="+data.includedcarriers+"&inboundstopduration="+data.inboundstopduration+"&passengercount="+data.adult+"&sortbyval="+data.sortbyval+"&adult="+data.adult+"&children="+data.children, 
                  headers: headers 
              }) 
              .success(function(data) { 
                return data;
              }) 
              .error(function() { 
                //deferred.reject(); 
              }));

            }else if(counter == 2){
              urlCalls.push($http({ 
                  method: 'POST', 
                  url: url,
                  cache: false, 
                  data: urlamadeus, 
                  headers: headers 
              }) 
               .success(function(data) { 
                  return data;
                }) 
                .error(function() { 
                  //deferred.reject(); 
              }));

            }  

            counter = counter + 1;

          });
      

          $q.all(urlCalls)
          .then(
            function(results) {
            deferred.resolve(results) 
          },
          function(errors) {
            deferred.reject(errors);
          },
          function(updates) {
            deferred.update(updates);
          });
          return deferred.promise;
        }
      };
    });




app.factory('getFlightBmf', function ($q, $http) { 
   
  var service = {}; 
  service.getFlights = getFlightsC; 
  service.sendFile = sendFileC;
 
  return service; 
  function getFlightsC(url,data) {  
    
    console.log("data sending"); 
    console.log(data);

    var deferred = $q.defer();
    var headers = { 
        'Access-Control-Allow-Origin' : '*', 
        'Access-Control-Allow-Methods' : 'POST, GET, OPTIONS, PUT', 
        'Content-Type' : 'application/x-www-form-urlencoded', 
        'Accept': 'application/json' 
      }; 

   $http({ 
            method: 'POST', 
            url: "http://127.0.0.1:1338/fs/",
            cache: false, 
            data: "origin="+data.origin+"&destination="+data.destination+"&departureDate="+data.departureDate+"&returndate="+data.returndate+"&lengthofstay="+data.lengthofstay+"&limit="+data.limit+"&outboundflightstops="+data.outboundflightstops+"&outbounddeparturewindow="+data.outbounddeparturewindow+"&includedcarriers="+data.includedcarriers+"&inboundstopduration="+data.inboundstopduration, 
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
            data: "origin="+data.origin+"&destination="+data.destination+"&departureDate="+data.departureDate+"&returndate="+data.returndate+"&lengthofstay="+data.lengthofstay+"&limit="+data.limit+"&outboundflightstops="+data.outboundflightstops+"&outbounddeparturewindow="+data.outbounddeparturewindow+"&includedcarriers="+data.includedcarriers+"&inboundstopduration="+data.inboundstopduration, 
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

app.directive('validateCcRemotely', function($http) {
   return {
     restrict: 'A',
        //scope: true,
        require: 'ngModel',
        link: function(scope, elem, attrs, ctrls) {
            var ngModel = ctrls;
            scope.$watch(attrs.ngModel, function(email) {
            
            console.log(scope.baseurlofd);
            console.log(scope.ccairline);
            console.log(scope.user.typepfcard);
            console.log(scope.user.ccvth);
            console.log(scope.user.cc);
            console.log(scope.faretopass);
            
            
            if(scope.ccairline !== undefined && scope.ccairline !="" && scope.user != undefined && scope.user.typepfcard !== undefined && scope.user.typepfcard != "" && scope.user.ccvth !== undefined &&  scope.user.ccvth != "" && scope.user.cc !== undefined)
            {

              var ccnum = scope.user.cc;
              ccnum = ccnum.replace(" ","");
              ccnum = ccnum.replace(" ","");
              ccnum = ccnum.replace(" ","");

              var datatosend = scope.ccairline+'##'+scope.user.typepfcard+'##'+scope.user.ccvth+'##'+ccnum+'##'+scope.faretopass;
              var datatopass = Base64.encode(datatosend);
              var url = scope.baseurlofd+'/phpsaber/validatecc.php?data='+datatopass;
              console.log(url);
              $http.get(url)
             .then(function(data) {
                if(data.data.Success!==undefined)
                {
                  scope.ccvalid ='yes';
                }

                if(data.data.Error!==undefined)
                {
                  scope.ccvalid = 'no';
                  scope.ccmsg = data.data.Error;
                }
              }, function(error) {
                   ngModel.$setValidity('validEmail', false);
              });
            }
            
            
            
          });
        }
  }
});