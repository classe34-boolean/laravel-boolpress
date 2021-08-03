<template>
  <section class="my-5" v-if="tag">
      <h1>Pagina di dettaglio del tag: <span class="badge badge-info badge-pills">{{ tag.name }}</span></h1>

      <ul>
        <li 
          v-for="post in tag.posts"
          :key="`post-${post.id}`"
        >
          <router-link :to="{ name: 'single-post', params: { slug: post.slug } }">{{ post.title }}</router-link>
        </li>
      </ul>
  </section>
  <Loader v-else />
</template>

<script>
import Loader from '../components/Loader';

export default {
    name: 'Tag',
    created: function() {
      this.getTag(this.$route.params.slug);
    },
    data: function() {
      return {
        tag: null
      };
    },
    components: {
      Loader
    },
    methods: {
      getTag: function(slug) {
        axios
          .get(`http://127.0.0.1:8000/api/tags/${slug}`)
          .then(
            res => {
              this.tag = res.data;
            }
          )
          .catch(
            err => {
              console.log(err);
            }
          );
      }
    }
}
</script>

<style scoped>
  ul {
    margin-left: 20px;
  }
</style>