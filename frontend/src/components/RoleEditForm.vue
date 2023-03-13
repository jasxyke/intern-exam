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
          <ErrorDisplay
            v-if="errors != null"
            :errors="errors"
          ></ErrorDisplay>
            <form>
              <div class="form-group">
                <label for="id">Id:</label>
                <input type="text" class="form-control" placeholder="Id"
                  v-model="roleState.role.id"
                  name="id" disabled
                >
              </div>
                <div class="form-group">
                  <label for="name">Name:</label>
                  <input type="text" class="form-control" placeholder="Role name"
                    v-model="roleState.role.name"
                    name="name"
                  >
                </div>
                <div class="form-group">
                  <label for="desc">Description: </label>
                  <textarea name="desc" type="textarea" class="form-control" placeholder="Description"
                  v-model="roleState.role.description"
                  ></textarea>
                </div>
              </form>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-success"
                    @click.prevent="edit"
            >Edit</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
  </div>
      
</template>
<script lang="ts">
import { roleState } from '../states/RoleState';
import axiosClient from '../axios';
import ErrorDisplay from './ErrorDisplay.vue';
export default {   
    emits: ['editRole'],
    components:{
      ErrorDisplay
    },
    data(){
        return{
            errors: null,
            roleState
        }
    },
    methods:{
      async edit(){  
        try{
          let role = {
              id: roleState.role.id,
              name: roleState.role.name,
              description: roleState.role.description
          }as any
          let res = await axiosClient.put(`/roles/${role.id}`,role);
          console.log('editied role');
          this.$emit('editRole', role);
        }catch(err:any){
          console.log(err);
          this.setError(err.response.data.errors);    
        }
    },
    setError(err:any){
      this.errors = err;
    }
  }
}
</script>
<style lang="">
    
</style>