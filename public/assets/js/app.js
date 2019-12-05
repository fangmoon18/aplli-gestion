// any CSS you require will output into a single css file (app.css in this case)
// require('../css/app.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// const $ = require('jquery');

var temps;
$(document).ready(function(){setInterval(MessageHide, 3000)});

function MessageHide(){
   var info= $("#info").slideUp();

}
