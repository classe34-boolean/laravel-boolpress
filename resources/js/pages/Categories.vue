<template>
  <section class="my-5" v-if="categories.length > 0">
      <h1>Elenco categorie</h1>

      <ul>
          <li
           v-for="category in categories"
           :key="`category-${category.id}`">
            <router-link :to="{ name: 'category', params: { slug: category.slug } }">{{ category.name }}</router-link>
          </li>
      </ul>
  </section>
  <Loader v-else />
</template>

<script>
import Loader from '../components/Loader';

export default {
    name: "Categories",
    components: {
        Loader
    },
    data: function() {
       return {
           categories: []
       }; 
    },
    created: function() {
        this.getCategories();
    },
    methods: {
        getCategories: function() {
            axios
                .get('http://127.0.0.1:8000/api/categories')
                .then(
                    res => {
                        this.categories = res.data;
                    }
                )
                .catch();
        }
    }
}
</script>

<style scoped>
  ul {
    margin-left: 20px;
  }
</style>