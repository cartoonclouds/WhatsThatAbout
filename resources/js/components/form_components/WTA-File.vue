<template>
    <div class="form-file form-file-lg mb-3">
        <label :for="name" :id="name+'Label'" class="form-label w-100 px-md-5 bg-light text-center d-flex justify-content-center align-items-center cover-image">

            <img v-if="src" v-bind:src="src" title="Cover Image" class="w-100 h-100">
            <template v-else>
                {{  label }}
            </template>

            <input v-bind="$attrs" type="file" v-on:change="updateFile($event.target.value)" :name="name" class="d-none form-file-input"  :id="name" :aria-describedby="name+'Label'">
            <span class="form-file-text d-none">Choose file...</span>
            <span class="form-file-button d-none">Browse</span>

        </label>

        <div class="valid-feedback"></div>

        <div v-if="errorsExists" class="invalid-feedback">
            <ul>
                <li v-for="error in errors">{{ error }}</li>
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
            src: this.value
        }
    },
    methods: {
        updateFile(src)
        {
            //@todo File preview https://stackoverflow.com/questions/4459379/preview-an-image-before-it-is-uploaded

            this.src = src

            this.$emit('input', src)
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
}
</script>

<style scoped>

</style>
