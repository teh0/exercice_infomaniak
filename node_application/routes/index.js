'use strict';

const axios = require('axios');
const mysql = require('mysql');

module.exports = function (app) {
    app.get('/', function (req, res) {
        res.render('pages/index');
    });

    app.post('/', function (req, res) {
        //Retrieve data from form
        let category = req.body.category;
        let table = req.body.table;
        // let table = books;
        // let category = PHP;

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


        // 1) First step, retrieve current books stored in database in stock them in array (listTitleBookStored)
        connection.query(retrieveCurrentBookStored, function (error, results, fields) {
            if (error) throw error;
            let listTitleBookStored = [];
            results.forEach(element => {
                listTitleBookStored.push(element.title);
            });
            
            // 2) Second step, retrieve data from GoogleBook API in relation to category pass by form
            axios.get(`https://www.googleapis.com/books/v1/volumes?q=${category}&maxResults=40`)
             .then(function (response) {
                 // Target book data from axios request
                 let dataBooks = response.data.items;

                 dataBooks.forEach(element => {

                    let newdataBooks = {
                        title: element.volumeInfo.title, 
                        authors: element.volumeInfo.authors,
                        url_thumbnail: element.volumeInfo.imageLinks.thumbnail,
                        description: element.volumeInfo.description,
                        pageCount: element.volumeInfo.pageCount,
                        lang: element.volumeInfo.language,
                        publishedDate: element.volumeInfo.publishedDate,
                        price: element.saleInfo.retailPrice.price.amount,
                    };
                    console.log(newdataBooks);
                 });
             });
        });

        // 2) Retrieve data from GoogleBook API in relation to category send from form

        res.render('pages/validation');
    });
};