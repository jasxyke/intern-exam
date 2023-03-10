<template lang="">
    <div class="alert alert-danger" v-for="(error, index) in errors" :key="index">
        {{error[0]}}
      </div>
</template>
<script lang="ts">
export default {
    props:['errors']
}
</script>
<style lang="">
    
</style>