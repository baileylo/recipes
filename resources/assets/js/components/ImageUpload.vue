<template>
    <div>
        <div class="rounded" style="background-color:white; border: 1px solid #999;font-size:128px;text-align:center" @drop.stop.prevent="drop" @dragenter.stop.prevent="dragEnter" @dragleave.stop.prevent="dragLeave" @dragover.stop.prevent="" @click="showFileSelector">
            <img :src="imageData" v-if="imageData" ref="preview" style="max-width: 100%; max-height: 100%">
            <img :src="currentSrc" v-else-if="currentSrc">
            <p class="align-items-center" v-else="imageData">
                <i class="fas fa-image"></i>
            </p>

        </div>
        <input type="file" ref="fileInput" name="image" class="form-control d-none" v-bind:class="{'is-invalid': error}" @change="onFileChange">
        <div class="invalid-feedback" :class="{'d-block': error}" v-text="error" v-if="error"></div>
    </div>

</template>

<script>
    export default {
        data: function () {
            return {
                imageHeight: 0,
                imageWidth: 0,
                imageData: '',
                error: '',
                over_drop_zone: false
            }
        },
        props: ['currentSrc'],
        methods: {
            dragEnter(e) {
                this.over_drop_zone = true;
            },
            dragLeave(e) {
                this.over_drop_zone = false;
            },
            drop(e) {
                this.$refs.fileInput.files = e.dataTransfer.files;
            },
            showFileSelector(e) {
                this.$refs.fileInput.click();
            },
            onFileChange(e) {
                const max_file_size = 10000000;
                const files         = e.target.files || e.dataTransfer.files;
                const image         = files[0] || false;
                this.error          = '';

                if (!image) {
                    return;
                }

                if (image.size > max_file_size) {
                    this.error = 'File must be less than 10 megabytes'
                    this.$refs.fileInput.value = null;
                    return;
                }

                if (image.type !== 'image/jpg' && image.type !== 'image/png' && image.type !== 'gif' && image.type !== 'image/jpeg') {
                    const image_type = image.type.split('/')[1] || 'unknown';
                    this.$refs.fileInput.value = null;
                    this.error = `File must either be jpg, png, or gif, got ${image_type}`
                    return;
                }

                const reader = new FileReader();
                reader.onload = (e) => {
                    const imageData   = e.target.result;
                    const hiddenImage = new Image();
                    hiddenImage.src = imageData;
                    hiddenImage.onload = (e) => {
                        if (hiddenImage.width > hiddenImage.height) {
                            this.imageWidth = '100%';
                            this.imageHeight = 'auto';
                        } else {
                            this.imageWidth = 'auto';
                            this.imageHeight = '100%';
                        }

                        this.imageData = imageData;
                    };

                    this.imageData = e.target.result;
                };
                reader.readAsDataURL(image);
            }
        }
    }
</script>