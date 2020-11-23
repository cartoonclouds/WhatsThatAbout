<template>
    <div class="mb-3">
        <label :for="name" :id="name+'Label'" class="form-label">{{  label }}</label>

        <div class="input-group input-group">
            <span v-if="preIcon" class="input-group-text">{{  preIcon }}</span>

            <textarea v-bind="$attrs" v-bind:value="value" v-on:input="$emit('input', $event.target.value)" type="text" :name="name" :class="validationClass" class="form-control" :id="name" :aria-label="placeholder" :aria-describedby="name+'Label'">
            </textarea>

            <span v-if="postIcon" class="input-group-text">{{  postIcon }}</span>

            <div class="valid-feedback"></div>

            <div v-if="errorsExists" class="invalid-feedback">
                <ul>
                    <li v-for="(error, id) in errors" v-bind:key="id">{{ error }}</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'wta-textarea',
    inheritAttrs: false,
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
    },
}
</script>

<style scoped>

</style>
