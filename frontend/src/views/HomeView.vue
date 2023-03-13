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

export default defineComponent({
    data(){
        return{
            user: userState
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