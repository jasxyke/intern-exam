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
                  v-model="userState.user.id"
                  name="id" disabled
                >
              </div>
                <div class="form-group">
                  <label for="name">Fullname:</label>
                  <input type="text" class="form-control" placeholder="Full name"
                    v-model="userState.user.fullname"
                    name="name"
                  >
                </div>
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" placeholder="Email"
                    v-model="userState.user.email"
                    name="email"
                  >
                </div>
                <div class="form-group">
                  <label for="role">Role:</label>
                  <select name="role" class="form-control" v-model="userState.user.role_id">
                      <option 
                      v-for="(role, index) in roles" :key="index" :value="role.id">
                          {{role.name}}
                      </option>
                  </select>
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
import {userState} from '../states/EditUserState'
import ErrorDisplay from './ErrorDisplay.vue';
import axiosClient from '../axios';
export default {   
    emits: ['editUser'],
    data(){
        return{
            userState,
            errors: null,
            roles: []
        }
    },
    components:{
      ErrorDisplay
    },
    methods:{
      async edit(){
        try{
          let user = {
            id: userState.user.id,
            fullname: userState.user.fullname,
            email: userState.user.email,
            role_id: userState.user.role_id
          }
          let res = await axiosClient.put(`/users/${user.id}`,user);
          console.log(res);
          this.$emit('editUser',res.data)
          
      }catch(err){
        this.setError(err);
      }
    },
    setError(err:any){
      this.errors = err.response.data.errors
    },
    async getRoles(){
      try{
            let res = await axiosClient.get('/roles');
            console.log(res.status);
            if(res.status == 200){
                this.roles = res.data;
            }else{
                console.log(res);
            }
        }catch(err){
            console.log(err); 
        }
    }
    },
     created(){
      this.getRoles();
    }
}
</script>
<style lang="">
    
</style>