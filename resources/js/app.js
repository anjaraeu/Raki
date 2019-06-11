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

Vue.component('submit-form', require('./components/SubmitForm.vue').default);

Vue.component('manage-form', require('./components/ManageForm.vue').default);

Vue.component('decrypt-file', require('./components/DecryptFile.vue').default);

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
    /* const app = */new Vue({
        el: '#app',
        data: {
            env: process.env,
            dropzone: null,
            csrf: document.head.querySelector('meta[name="csrf-token"]').content
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
                    addRemoveLinks: true,
                    dictDefaultMessage: this.$lang.get('dropzone.dictDefaultMessage'),
                    dictFallbackMessage: this.$lang.get('dropzone.dictFallbackMessage'),
                    dictFallbackText: this.$lang.get('dropzone.dictFallbackText'),
                    dictFileTooBig: this.$lang.get('dropzone.dictFileTooBig'),
                    dictInvalidFileType: this.$lang.get('dropzone.dictInvalidFileType'),
                    dictInvalidFileType: this.$lang.get('dropzone.dictInvalidFileType'),
                    dictResponseError: this.$lang.get('dropzone.dictResponseError'),
                    dictCancelUpload: this.$lang.get('dropzone.dictCancelUpload'),
                    dictUploadCanceled: this.$lang.get('dropzone.dictUploadCanceled'),
                    dictCancelUploadConfirmation: this.$lang.get('dropzone.dictCancelUploadConfirmation'),
                    dictRemoveFile: this.$lang.get('dropzone.dictRemoveFile'),
                    dictRemoveFileConfirmation: this.$lang.get('dropzone.dictRemoveFileConfirmation'),
                    dictMaxFilesExceeded: this.$lang.get('dropzone.dictMaxFilesExceeded'),
                    init: function() {
                        this.on('complete', function(file) {
                            document.dispatchEvent(new Event('uploadingunlock'));
                        });
                        this.on('processing', function(file) {
                            document.dispatchEvent(new Event('uploadinglock'));
                        });
                        this.on('sending', function(_file, _xhr, formdata) {
                            formdata.append('_token', document.head.querySelector('meta[name="csrf-token"]').content);
                        });
                        this.on('removedfile', file => {
                            axios.delete('/upload', {
                                params: {
                                    name: file.name
                                }
                            });
                        });
                    }
                });
            }

            document.addEventListener('uploadinglock', function(e) {
                console.log('BITCONNECT!', e);
            }, false);

            document.addEventListener('uploadingunlock', function(e) {
                console.log('CONNEEEEEEEEEEEEEECT!', e);
            }, false);

            $('.ui.dropdown').dropdown();
            $('.ui.checkbox').checkbox();
            $('[data-popup-activate=on]').popup({
                inline: true
            });

            new ClipboardJS('#copybtn');
        },
        methods: {
            openModal(id) {
                $('#file'+id).modal('show');
            }
        }
    });
});

