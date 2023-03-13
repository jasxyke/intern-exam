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
      this.getMe();
    },
    methods:{
        async getMe(){
            try{
            const res = await axiosClient.get('/user');
            let user = res.data;
            console.log(user);
            if(!user){
                throw 'no user found';
            }
            userState.setUser(user);
            this.$router.push('/home');
        }catch(err){
          console.log(err); 
          window.location.href = "/login"
        }
        }
    }
}
</script>
<style lang="">
    
</style>


                