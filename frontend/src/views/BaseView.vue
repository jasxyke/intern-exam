<template lang="">
    <NavBar></NavBar>
    <router-view></router-view>
</template>
<script lang="ts">
import NavBar from '../components/NavBar.vue';
import { tokenState } from '../states/TokenState';
import axiosClient from '../axios';
import { userState } from '../states/UserState';
export default {
    components:{
        NavBar
    },
    created(){
        let token = tokenState.getToken()
        console.log(token);  
      if(token == null){
        //this.$router.push('/login')
        window.location.href = "/login"
        return
      }
      //window.location.href = "/home"
      this.$router.push('/home')
    }
}
</script>
<style lang="">
    
</style>


                