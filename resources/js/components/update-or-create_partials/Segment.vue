<template>
    <form>
        <div class="mb-3">
            <label for="title" class="col-form-label">Title:</label>
            <input type="text" name="title" class="form-control" id="title" v-model="model.title">
        </div>
        <div class="mb-3">
            <label for="start_time" class="col-form-label">Start Time:</label>
            <input type="text" name="start_time" class="form-control" id="start_time" v-model="model.start_time">
        </div>
        <div class="mb-3">
            <label for="finish_time" class="col-form-label">Finish Time:</label>
            <input type="text" name="finish_time" class="form-control" id="finish_time" v-model="model.finish_time">
        </div>
        <div class="mb-3">
            <label for="runs_throughout" class="col-form-label">Runs Throughout:</label>
            <input type="checkbox" name="runs_throughout" class="form-control form-check-input" id="runs_throughout" v-model="model.runs_throughout">
        </div>

        <div class="mb-3">
            <label for="synopsis" class="col-form-label">Details:</label>
            <textarea name="synopsis" class="form-control" id="synopsis">
                {{ model.details }}
            </textarea>
        </div>
    </form>
</template>

<script>
export default {
    props: ['model'],
    data() {
        return {
            //
        }
    },
    methods: {
        //
    },
}
</script>

<style scoped>

</style>
