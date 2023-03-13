<template lang="">
    <NavBar></NavBar>
    <router-view></router-view>
</template>
<script lang="ts">
import NavBar from '../components/NavBar.vue';
import { tokenState } from '../states/TokenState';
export default {
    components:{
        NavBar
    },
    created(){
        let token = tokenState.getToken()
      if(token == null){
        //this.$router.push('/login')
        window.location.href = "/login"
      }
    }
}
</script>
<style lang="">
    
</style>


                