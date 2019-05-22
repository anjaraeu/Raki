/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

Vue.component('submit-form', require('./components/SubmitForm.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

axios.get('/language.json').then(res => {
    /* const app = */new Vue({
        el: '#app',
        data: {
            language: res.data,
            lang: null,
            env: process.env,
            dropzone: null,
            csrf: document.head.querySelector('meta[name="csrf-token"]').content
        },
        created() {
            this.lang = new Lang({
                messages: this.language,
                locale: require('cookie-universal')().get('lang'),
                fallback: this.language.defaultlang
            });
        },
        mounted() {
            if ($('#anjaradrop').length > 0) {
                this.dropzone = new Dropzone('#anjaradrop', {
                    url: '/upload',
                    paramName: "file", // The name that will be used to transfer the file
                    maxFilesize: 500, // MB
                    maxFiles: 5,
                    chunking: true,
                    chunkSize: 1000000,
                    init: function() {
                        this.on('uploadprogress', function(file, progress, bytesSent) {
                            console.log(file, progress, bytesSent);
                        });
                        this.on('sending', function(_file, _xhr, formdata) {
                            formdata.append('_token', document.head.querySelector('meta[name="csrf-token"]').content);
                        });
                    }
                });
            }

            $('.ui.dropdown').dropdown();
            $('.ui.checkbox').checkbox();
        }
    });
});

