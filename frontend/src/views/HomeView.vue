<template>
    <div class="box">
        <h2>
            Hello, {{ user?.user?.fullname ?? 'unknown' }}
        </h2>
    </div>
    
</template>

<script lang="ts">
import { userState } from '../states/UserState';
import { defineComponent } from 'vue'
import axiosClient from '../axios';

export default defineComponent({
    data(){
        return{
            user: userState
        }
    },
    created(){
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
        }catch(err){
          console.log(err); 
          window.location.href = "/login"
        }
        }
    }
});

</script>
<style scoped>
    .box{
        display: flex;
        justify-content: center;
        height: 50vh;
        align-items: center;
    }
</style>