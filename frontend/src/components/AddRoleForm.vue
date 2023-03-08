<template lang="">

    <!-- The Modal -->
<div class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add Role</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            <form>
                <div class="form-group">
                  <label for="name">Name:</label>
                  <input type="text" class="form-control" placeholder="Name"
                    v-model="name"
                  >
                </div>
                <div class="form-group">
                  <label for="desc">Description: </label>
                  <textarea name="desc" type="textarea" class="form-control" placeholder="Description"
                    v-model="description"
                  ></textarea>
                </div>
              </form>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                    @click="add"
            >Add</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
  </div>
      
</template>
<script lang="ts">
export default {
    emits: ['addRole'],
    data(){
        return{
            name: '',
            description: ''
        }
    },
    methods:{
        add(){
            this.$emit('addRole',{
                name:this.name,
                description: this.description
            });
            this.name = '',
            this.description = '';
        }
    }

}
</script>
<style lang="">
    
</style>