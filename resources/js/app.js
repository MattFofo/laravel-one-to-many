/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import 'bootstrap';

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});



//delete overlay confirmation


const eleConfirmationDelete = document.querySelector('#confirmation-delete');
if (eleConfirmationDelete) {

    const eleBtnNotDelete = document.querySelector('#btn-not-delete');
    const formDelete = eleConfirmationDelete.querySelector('form');
    document.querySelectorAll('.btn-delete').forEach(element => {
        element.addEventListener('click', function () {
            const idFromSlug = element.closest('tr').dataset.id;
            const formDeleteAction = formDelete.dataset.base.replace('*****', idFromSlug);
            formDelete.action = formDeleteAction;

            eleConfirmationDelete.classList.toggle('invisible');
        })
    });
    eleBtnNotDelete.addEventListener('click', function () {
        formDelete.action = '';
        eleConfirmationDelete.classList.toggle('invisible');
    })
}



//sostituire spazi bianchi dello slug
// const eleSlug = document.querySelector('#slug');

// if (eleSlug) {
//     document.querySelector('.btn').addEventListener('click', function () {
//         eleSlug.value = eleSlug.value.replace(/ /g, '-');
//     })

// }


//generate slug
const btnGenerateSlug = document.querySelector('#generateSlug');

if (btnGenerateSlug) {
    const eleSlug = document.querySelector('#slug');

    btnGenerateSlug.addEventListener('click', function () {
        const postTitle = document.querySelector('#title').value;
        eleSlug.value = postTitle.replace(/ /g, '-');
    })
}
