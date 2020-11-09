<template>
    <form @submit.prevent="save">
        <div class="card">
            <div class="row">

                <div class="col-3 py-4 px-5">
                    <label class="form-label cover_image" aria-describedby="cover_imageHelp" for="cover_image">
                        <img v-if="model.cover_image" :src="model.cover_image" :title="model.title + ' Cover Image'" class="w-100 h-100">
                        <template v-else>
                            Upload cover (270 x 400)
                        </template>

                        <input type="file" name="page-cover" class="d-none" id="cover_image">
                    </label>
                    <div id="cover_imageHelp" class="form-text">Add new thumbnail.</div>
                </div>

                <div class="col-9 pr-5">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" name="title" class="form-control" id="title" v-model="model.title">
                    </div>
                    <div class="mb-3">
                        <label for="release_year" class="form-label">Release Year:</label>
                        <input type="text" name="release_year" class="form-control" id="release_year" v-model="model.release_year">
                    </div>
                    <div class="mb-3">
                        <label for="runtime" class="form-label">Runtime:</label>
                        <input type="text" name="runtime" class="form-control" id="runtime" v-model="model.runtime">
                    </div>
                    <div class="mb-3">
                        <label for="synopsis" class="form-label">Synopsis:</label>
                        <textarea name="synopsis" class="form-control" rows="10" id="synopsis">
                            {{ model.synopsis }}
                        </textarea>
                    </div>
                </div>

            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
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
        save()
        {
            axios.post(this.url, new FormData(this.$el))
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.log(error);
                })
        }
    },
    computed: {
        url()
        {
            return `/api/pages/updateOrCreate/${this.model.slug}`
        },
    }
}
</script>

<style scoped>

</style>
