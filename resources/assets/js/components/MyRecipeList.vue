<template>
    <div>
        <div class="row" v-for="recipes in recipeGroups">
            <my-recipe-list-item v-for="recipe in recipes" :key="recipe.id" :recipe="recipe" @deleteRecipe="removeRecipe"></my-recipe-list-item>
        </div>
    </div>
</template>

<script>
    import _ from 'lodash';
    import RecipeItem from './MyRecipeListItem.vue'

    export default {
        components: {
            RecipeItem
        },
        methods: {
            removeRecipe: function(recipe) {
                const recipes = this.recipes;
                axios.delete(`/my-recipes/${recipe.id}`)
                    .then(function (response) {
                        const index = _.findIndex(recipes, {id: recipe.id});
                        Vue.delete(recipes, index);
                    })
                    .catch(function (error) {
                        console.log(error);
                        console.log('failed to delete the recipe');
                    });
            }
        },
        data: function () {
            return {
                recipes: window.myRecipes || []
            }
        },
        computed: {
            recipeGroups: function () {
                return _.chunk(this.recipes, 4);
            }
        }
    }
</script>
