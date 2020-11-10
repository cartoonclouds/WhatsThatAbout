<template>
    <div class="form-check mb-3">
        <input v-bind="$attrs" v-model="value" v-on:change="$emit('input', value)" :name="name" type="checkbox" :class="validationClass" class="form-check-input" :id="name" :aria-describedby="name+'Label'">

        <label :for="name" :id="name+'Label'" class="form-check-label">{{  label }}</label>

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
    name: 'wta-checkbox',
    props: {
        name: {
            required: true,
            type: String,
        },
        value: {
            required: true,
            type: Boolean,
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
