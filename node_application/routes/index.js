'use strict';

const axios = require('axios');
const mysql = require('mysql');

module.exports = function (app) {

    let categroyID = {
        'php': '1',
        'javascript': '2',
        'html': '3',
        'css': '4',
        'python': '5',
        'nodejs': '6',
    };
    let category;
    let table
    app.get('/', function (req, res) {
        res.render('pages/index');
    });

    app.post('/', function (req, res) {
        category = req.body.category;
        table = 'books';

        //Instance local database connection 
        const connection = mysql.createConnection({
            host: 'localhost',
            user: 'root',
            password: '',
            database: 'infomaniak',
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
                    let validBooks = [];
                    dataBooks.forEach(element => {

                        let newdataBook = {
                            title: element.volumeInfo.title,
                            authors: element.volumeInfo.authors,
                            description: element.volumeInfo.description,
                            pageCount: element.volumeInfo.pageCount,
                            lang: element.volumeInfo.language,
                            publishedDate: element.volumeInfo.publishedDate,

                        };
                        if (element.volumeInfo.imageLinks) {
                            newdataBook.url_thumbnail = element.volumeInfo.imageLinks.thumbnail;
                        }
                        // If a value of props is undefined (length != 7), we don't keep the book
                        if (Object.values(newdataBook).length === 7) {
                            console.log(newdataBook.title);
                            validBooks.push(newdataBook);
                        }
                    });
                    //At the step, we have book from database stored in "listTitleBookStored" and book from Google API in "validBooks"
                    // Now let's compare them to update or create new Book in database
                });
        });
        res.render('pages/validation');
    });
};