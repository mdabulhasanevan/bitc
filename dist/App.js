//var baseUrl="https://www.bitc.ac.bd/";
var baseUrl="https://bitc.expresstechbd.com/";

var CollegeName="Barisal Information Technology College-BITC";
var app = angular.module("myApp",['ngRoute'] );
 
 
//,'ui.bootstrap'
app.filter('beginning_data', function() {
    return function(input, begin) {
        if (input) {
            begin = +begin;
            return input.slice(begin);
        }
        return [];
    }
});


