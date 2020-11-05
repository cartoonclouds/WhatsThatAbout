<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ details.title }}

                        <button type="button" class="btn btn-dark float-right" v-if="!editing" @click="editing = true">Edit</button>
                        <button type="button" class="btn btn-dark float-right" v-else @click="save">Save</button>
                    </div>

                    <div v-if="editing" class="card-body">
                        <textarea v-model="comment"></textarea>
                    </div>

                    <div v-else class="card-body">
                        {{ comment }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['details'],
        name: 'comment',
        data() {
            return {
                editing: false,
                comment: this.details.body
            }
        },
        methods: {
            save()
            {
                this.editing = false;
            }
        },
        computed: {

        },
    }
</script>
