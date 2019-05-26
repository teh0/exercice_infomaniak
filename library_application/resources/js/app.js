/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import InitTurbolinks from './customClass/InitTurboLinks';
class App {
	constructor() {
		console.log("%c  ", "background-image: url('https://borrowell.championtheo.fr/img/logo_borrowell.svg'); background-repeat: no-repeat; background-size: 128px 128px; font-size: 128px;")
		this.initApp();
	}

	initApp() {
        this.InitTurbolinks = new InitTurbolinks();
	}
}

new App();