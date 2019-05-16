'use strict';

const axios = require('axios');
const mysql = require('mysql');

module.exports = function (app) {
    app.get('/', function (req, res) {
        let success = 'succès !!';
        let error = '';
        res.render('pages/index', {
            success: success,
            error: error,
        });
    });

    app.post('/', function (req, res) {
        //Retrieve data from form
        let category = req.body.category;
        let table = req.body.table;

        //Instance local database connection 
        const connection = mysql.createConnection({
            host: 'localhost',
            user: 'root',
            password: '',
            database: 'infomaniak'
        });
        connection.connect();

        //Prepare queries for database
        let retrieveCurrentBookStored = `SELECT * FROM ${table}`;


        // 1) First step, retrieve current books stored in database


        // 2) Retrieve data from GoogleBook API in relation to category send from form

        res.render('pages/validation');
    });
};