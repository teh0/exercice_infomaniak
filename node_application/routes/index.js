'use strict';

const axios = require('axios');
const mysql = require('mysql');
var moment = require('moment');


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


        // 1) First step, retrieve current books stored in database in stock them in array (listBookStored)
        connection.query(retrieveCurrentBookStored, function (error, results, fields) {
            if (error) throw error;
            let listBookStored = [];
            results.forEach(element => {
                listBookStored.push(element);
            });

            // 2) Second step, retrieve data from GoogleBook API in relation to category pass by form
            axios.get(`https://www.googleapis.com/books/v1/volumes?q=${category}&maxResults=40`)
                .then(function (response) {
                    // Target book data from axios request
                    let dataBooks = response.data.items;
                    let listValidBooks = [];
                    dataBooks.forEach(element => {

                        let newdataBook = {
                            title: element.volumeInfo.title,
                            authors: element.volumeInfo.authors,
                            description: element.volumeInfo.description,
                            pageCount: element.volumeInfo.pageCount,
                            lang: element.volumeInfo.language,

                        };
                        if (element.volumeInfo.imageLinks) {
                            newdataBook.small_thumbnail = element.volumeInfo.imageLinks.thumbnail.replace('http', 'https');
                        }
                        // If a value of props is undefined or total props number != 6, we don't keep the book
                        if (Object.values(newdataBook).length === 6 && !Object.values(newdataBook).includes(undefined)) {
                            newdataBook.large_thumbnail = newdataBook.small_thumbnail.replace('zoom=1', 'zoom=0.5');
                            listValidBooks.push(newdataBook);
                        }
                    });

                    //At the step, we have books from database stored in "listBookStored" and book from Google API in "listValidBooks"
                    // Now let's compare them (in relation to title and description) to update or create new Book in database
                    let listTitleBookStored = [];
                    let listDescriptionBookStored = [];
                    let listNewBooksStored = [];
                    listBookStored.forEach(element => {
                        listTitleBookStored.push(element.title);
                        listDescriptionBookStored.push(element.description);
                    });

                    listValidBooks.forEach(element => {
                        if (!listTitleBookStored.includes(element.title) && !listDescriptionBookStored.includes(encodeURI(element.description))) {
                            listNewBooksStored.push(element);
                            connection.query(`INSERT INTO ${table} (category_id, title, authors, small_thumbnail, large_thumbnail, description, pageCount, lang, fromApi, created_at, updated_at) 
                            VALUES ("${categroyID[category]}", "${element.title}", "${element.authors}", "${element.small_thumbnail}", "${element.large_thumbnail}", "${encodeURI(element.description)}", "${element.pageCount}", "${element.lang}", true, "${moment().format('YYYY-MM-DD HH:mm:ss')}", "${moment().format('YYYY-MM-DD HH:mm:ss')}")`, function (error, results, fields) {
                                if (error) throw error;
                            });
                        }
                    });
                    //We pass data of new books in view
                    res.render('pages/index', {
                        data: listNewBooksStored,
                    });
                });
        });
    });
};