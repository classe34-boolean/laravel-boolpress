<template>
  <div class="text-center my-5">
      <h1>{{ title }}</h1>
      <h2>{{ subtitle }}</h2>
  </div>
</template>

<script>
export default {
    name: 'WorkInProgress',
    props: [ 'title', 'subtitle' ]
}
</script>

<style lang="scss" scoped>
    $mainColor: red;
    h1 {
        color: $mainColor
    }
</style>