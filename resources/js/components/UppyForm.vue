<template>
    <div>
        <div class="DashboardContainer">
        </div>
    </div>
</template>

<script>
    import Uppy from "@uppy/core";
    import Tus from "@uppy/tus";
    import French from "@uppy/locales/lib/fr_FR";
    import Dashboard from "@uppy/dashboard";
    import GoldenRetriever from "@uppy/golden-retriever";

    export default {
        props: ['reset'],
        data() {
            return {
                uppy: null
            }
        },
        mounted() {
            this.uppy = Uppy({
                debug: true,
                autoProceed: true,
                restrictions: {
                    maxFileSize: process.env.MIX_MAX_FILE_SIZE * 1048576,
                    maxNumberOfFiles: 5
                },
                locale: French
            }).use(Dashboard, {
                inline: true,
                target: '.DashboardContainer',
                note: this.$lang.get('welcome.note', {size: this.$env.maxSize}),
                replaceTargetContent: true,
                showProgressDetails: true,
                width: "100%",
                height: 570,
                showLinkToFileUploadResult: false
            }).use(GoldenRetriever, {
                serviceWorker: false
            }).use(Tus, {
                endpoint: `${this.$env.url}/tus`,
                resume: true,
                autoRetry: true,
                retryDelays: [0, 1000, 3000, 5000]
            }).on('upload-success', (file, response) => {
                this.$emit('file-uploaded', {file, response});
            });
        },
        watch: {
            reset(newVal, _oldVal) {
                if (newVal === true) {
                    this.uppy.reset();
                }
            }
        }
    }
</script>
