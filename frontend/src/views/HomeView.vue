<template>
    <div class="box">
        <h2>
            Hello, {{ user.user.fullname }}
        </h2>
    </div>
    
</template>

<script lang="ts">
import axios from '../axios';
import { userState } from '../states/UserState';
import { defineComponent } from 'vue'

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
            const res = await axios.get('/user');
            let user = res.data;
            userState.setUser(user);
        }catch(err){
            console.log(err);
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