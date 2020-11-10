<template>
    <div class="mb-3">
        <label :for="name" :id="name+'Label'" class="form-label">{{  label }}</label>

        <div class="input-group input-group-lg">
            <span v-if="preIcon" class="input-group-text">{{  preIcon }}</span>

            <input v-bind="$attrs" v-bind:value="value" :name="name" :data-inputmask="mask" v-on:input="$emit('input', $event.target.value)" autocomplete="off" type="text" :class="validationClass" class="form-control form-control-lg" :id="name" :placeholder="placeholder" :aria-label="placeholder" :aria-describedby="name+'Label'">

            <span v-if="postIcon" class="input-group-text">{{  postIcon }}</span>

            <div class="valid-feedback"></div>

            <div v-if="errorsExists" class="invalid-feedback">
                <ul>
                    <li v-for="error in errors">{{ error }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'wta-input',
    props: {
        name: {
            required: true,
            type: String,
        },
        value: {
            required: true,
        },
        placeholder: {
            required: false,
            type: String,
            default: undefined,
        },
        label: {
            required: true,
            type: String
        },
        feedback: {
            required: false,
            type: [Object, Array],
            default() {
                return {}
            },
        },
        'preIcon': {
            required: false,
            type: String,
            default: undefined,
        },
        'postIcon': {
            required: false,
            type: String,
            default: undefined,
        },
        inputMask: {
            required: false,
            type: String,
            default: undefined,
        },
        wasValidated: {
            required: false,
            type: Boolean,
        }
    },
    data() {
        return {
            //
        }
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
        mask()
        {
            return this.inputMask ? `'mask': '${this.inputMask}'` : false
        },
    },
}
</script>

<style scoped>

</style>
