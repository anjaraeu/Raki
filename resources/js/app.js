/**
 * First we will load Fomantic UI components in the Windows the old-fashioned way.
 * It also loads axios.
 * Then we import all the packages we need
 */

require('./bootstrap');
import Vue from 'vue';
import Lang from 'lang.js';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('upload-form', require('./components/UploadForm').default);

Vue.component('uppy-form', require('./components/UppyForm.vue').default);

Vue.component('share-form', require('./components/ShareForm.vue').default);

Vue.component('submit-form', require('./components/SubmitForm.vue').default);

Vue.component('manage-form', require('./components/ManageForm.vue').default);

Vue.component('decrypt-file', require('./components/DecryptFile.vue').default);

Vue.component('report-form', require('./components/ReportForm.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

axios.get('/language.json').then(res => {
    Vue.prototype.$lang = new Lang({
        messages: res.data,
        locale: require('cookie-universal')().get('lang'),
        fallback: res.data.defaultlang
    });
    Vue.prototype.$env = {
        url: process.env.MIX_APP_URL,
        name: process.env.MIX_APP_NAME,
        defaultExp: process.env.MIX_DEFAULT_EXPIRATION,
        maxExp: process.env.MIX_MAX_EXPIRATION,
        maxSize: process.env.MIX_MAX_FILE_SIZE
    }
    /* const app = */new Vue({
        el: '#app',
        data: {
            dropzone: null,
            csrf: document.head.querySelector('meta[name="csrf-token"]').content
        },
        mounted() {
            $('.ui.dropdown').dropdown();
            $('.ui.checkbox').checkbox();
            $('[data-popup-activate=on]').popup({
                inline: true
            });
        },
        methods: {
            openModal(id) {
                $('#file'+id).modal('show');
            }
        }
    });
});

/**
 * At the end, register the Service Worker for Golden Retriever Uppy plugin.
 */

if ('serviceWorker' in navigator) {
    navigator.serviceWorker
        .register(`${process.env.MIX_APP_URL}/js/sw.js`) // path to your bundled service worker with GoldenRetriever service worker
        .then((registration) => {
            console.log('ServiceWorker registration successful with scope: ', registration.scope)
        })
        .catch((error) => {
            console.log('Registration failed with ' + error)
        })
}
