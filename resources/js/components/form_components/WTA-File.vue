<template>
    <div class="form-file form-file mb-3 position-relative">
        <i v-on:click="removeImage" v-if="imageSrc" class="fa fa-times-circle button-red remove-image"></i>
        <label :for="name" :id="name+'Label'" class="form-label w-100 h-100 p-4 bg-light text-center d-flex justify-content-center align-items-center cover-image">

            <img v-if="imageSrc" v-bind:src="imageSrc" title="Cover Image" class="w-100 h-100">

            <template v-else>
                {{  label }}
            </template>

            <input v-bind="$attrs" accept="image/*" type="file" v-on:change="readImage($event.target)" :name="name" class="d-none form-file-input"  :id="name" :aria-describedby="name+'Label'">
            <span class="form-file-text d-none">Choose file...</span>
            <span class="form-file-button d-none">Browse</span>

        </label>

        <div class="valid-feedback"></div>

        <div v-if="errorsExists" class="invalid-feedback">
            <ul>
                <li v-for="(error, id) in errors" v-bind:key="id">{{ error }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: 'wta-file',
    props: {
        name: {
            required: true,
            type: String,
        },
        value: {
            required: true
        },
        label: {
            required: false,
            type: String,
            default: ''
        },
        feedback: {
            required: false,
            type: [Object, Array],
            default() {
                return {}
            },
        },
        wasValidated: {
            required: false,
            type: Boolean,
        }
    },
    data() {
        return {
            imageSrc: this.value,
            FileReader: new FileReader(),
        }
    },
    methods: {
        async readImage(fileInput)
        {
            if (fileInput.files && fileInput.files[0]) {
                await this.FileReader.readAsDataURL(fileInput.files[0])
            }
        },
        removeImage()
        {
            this.imageSrc = '';
        },
    },
    computed: {
        errorsExists()
        {
            return this.name in this.feedback
        },
        errors()
        {
            return this.wasValidated && this.errorsExists ? this.feedback[this.name] : {}
        },
        validExists()
        {
            return false
        },
        validationClass()
        {
            if (this.wasValidated) {
                return this.errorsExists ? 'is-invalid' : 'is-valid'
            }
        },
    },
    watch:
    {
        imageSrc(src)
        {
            this.$emit('input', src)
        },
    },
    mounted() {

        //@todo Extend for compatibility for browsers
        // https://stackoverflow.com/a/43068357
        // https://stackoverflow.com/a/22559869

        if (typeof (FileReader) != "undefined") {
            this.FileReader.addEventListener('load', (event) => {
                this.imageSrc = this.FileReader.result
            })
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    }
}
</script>

<style scoped>
    .remove-image {
        position: absolute;
        top: -0.5em;
        right: -0.5em;
        font-size: 1.5em;
        color: orangered;
        z-index: 2;
    }
</style>
