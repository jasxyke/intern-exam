<template lang="">

    <!-- The Modal -->
<div class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Edit Role</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="id">Id:</label>
                <input type="text" class="form-control" placeholder="Id"
                  v-model="role_.id"
                  name="id" disabled
                >
              </div>
                <div class="form-group">
                  <label for="name">Name:</label>
                  <input type="text" class="form-control" placeholder="Role name"
                    v-model="role_.name"
                    name="name"
                  >
                </div>
                <div class="form-group">
                  <label for="desc">Description: </label>
                  <textarea name="desc" type="textarea" class="form-control" placeholder="Description"
                  v-model="role_.description"
                  ></textarea>
                </div>
              </form>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                    @click.prevent="edit"
            >Edit</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
  </div>
      
</template>
<script lang="ts">
export default {   
    emits: ['editRole'],
    inject:{
      role:{
        from:'role'
      }
    },
    data(){
        return{
            role_: this.role
        }
    },
    computed:{
    },
    methods:{
      edit(){
      console.log('editied role');
      
      this.$emit('editRole',{
        name: this.role_.name,
        description: this.role_.description
      });
    }
    }
}
</script>
<style lang="">
    
</style>