/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import InitTurbolinks from './customClass/InitTurboLinks';
class App {
	constructor() {
        console.log('Application Borrowell lancée !');
		this.initApp();
	}

	initApp() {
        this.InitTurbolinks = new InitTurbolinks();
	}
}

new App();