'use strict';

//Load all dependencies
var express = require('express');
var routes = require('./routes/index.js');
var port = process.env.PORT || 3000;
var app = express();


//Config the Node server
app.use( express.static( "public" ) );
app.use(express.urlencoded({extended: true}));
app.use(express.json());
app.set('view engine', 'ejs');


//Load router
routes(app);


//Lauch the server
app.listen(port, function() {
 console.log(`Server listening on http://localhost:${port}`);
});