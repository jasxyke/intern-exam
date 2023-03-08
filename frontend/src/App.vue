<template>
  <router-view></router-view>
</template>

<script lang="ts">
  import {tokenState} from './states/TokenState'
  export default{
    created(){
      let token = tokenState.getToken()
      if(!token){
        this.$router.push('/login')
      }
    }
  }
</script>

<style>

</style>
