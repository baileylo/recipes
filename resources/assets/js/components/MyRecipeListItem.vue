<template>
    <div class="col-lg-4">
        <div class="card" style="max-width: 18rem;">
            <img class="card-img-top" v-if="recipe.image_url"
                 :src="recipe.image_url"
                 :alt="recipe.title">
            <div v-else style="width: 100%; height: 0; padding-top:75%; background: #ccc"></div>
            <div class="card-body">
                <h5 class="card-text">
                    <a :href="this.viewUrl" :name="recipe.title" v-text="recipe.title"></a>
                </h5>
            </div>
            <div class="card-footer text-right">
                <small class="text-muted"><a :href="this.editUrl">Edit</a></small>
                |
                <small class="text-muted">
                    <a href="#" v-on:click="$emit('deleteRecipe', recipe)" :title="recipe.title">Delete</a>
                </small>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            recipe: {
                type: Object,
                required: true
            }
        },
        computed: {
            viewUrl: function () {
                return `/recipes/${this.recipe.id}/`;
            },
            editUrl: function () {
                return `/my-recipes/${this.recipe.id}/edit`;
            }
        }
    }
</script>
