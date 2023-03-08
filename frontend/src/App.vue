<template>
  <router-view></router-view>
</template>

<script lang="ts">
  export default{
    created(){
      this.$router.push('/login')
    }
  }
</script>

<style>

</style>
