<template>
  <!-- <section class="my-5" v-if="!loading && JSON.stringify(post) != '{}'"> -->
    <section class="my-5" v-if="!loading">
      <h1>{{ post.title }}</h1>

        <div class="post-info my-3">
            <div class="h4" v-if="post.category">
                <router-link class="badge badge-primary" :to="{ name: 'category', params: { slug: post.category.slug } }">{{ post.category.name }}</router-link>
            </div>
            <div class="h5" v-if="post.tags.length > 0">
                <!-- <span 
                    v-for="tag in post.tags"
                    :key="`tag-${tag.id}`"
                    class="badge badge-pills badge-info mr-2">
                {{ tag.name }}
                </span> -->

                <router-link
                    class="badge badge-pills badge-info mr-2"
                    v-for="tag in post.tags"
                    :key="`tag-${tag.id}`"
                    :to="{ name: 'tag', params: { slug: tag.slug } }"
                >{{ tag.name }}
                </router-link>
            </div>
        </div>

      <p class="my-4">{{ post.content }}</p>

      <router-link class="btn btn-primary" :to="{ name: 'blog' }">Torna al Blog</router-link>
  </section>
  <!-- <NotFound v-else-if="JSON.stringify(post) == '{}' && !loading" /> -->
  <Loader v-else />
</template>

<script>
import Loader from '../components/Loader';
// import NotFound from './NotFound';

export default {
    name: 'SinglePost',
    components: {
        Loader,
        // NotFound
    },
    data: function() {
        return {
            post: null,
            loading: true
        }
    },
    created: function() {
        this.getPost(this.$route.params.slug);
    },
    methods: {
        getPost: function(slug) {
            axios
                .get(`http://127.0.0.1:8000/api/posts/${slug}`)
                .then(
                    res => {
                        // if(JSON.stringify(res.data) == '{}') {
                        if(Object.keys(res.data).length == 0){    
                           this.$router.push({ name: 'not-found' });     
                        } else {
                            this.post = res.data;
                            this.loading = false;
                        }              
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

<style>

</style>