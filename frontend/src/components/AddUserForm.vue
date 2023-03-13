<template lang="">

    <!-- The Modal -->
<div class="modal">
    <div class="modal-dialog">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Add User</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body">
            <ErrorDisplay
                v-if="errors!=null"
                :errors="errors"
            ></ErrorDisplay>
            <SuccessDisplay
              v-if="response!==''"
              :message="response"
            ></SuccessDisplay>
            <form>
                <div class="form-group">
                  <label for="name">Fullname:</label>
                  <input type="text" class="form-control" placeholder="Fullname"
                    v-model="fullname"
                  >
                </div>
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" name="email" class="form-control" placeholder="Email"
                    v-model="email"
                  >
                </div>
                <div class="form-group">
                    <label for="pass">Password:</label>
                    <input type="password" name="pass" class="form-control" placeholder="Password"
                      v-model="password"
                    >
                  </div>
                  <div class="form-group">
                    <label for="con_pass">Confirm Password:</label>
                    <input type="password" name="con_pass" class="form-control" placeholder="Confirm password"
                      v-model="password_confirmation"
                    >
                  </div>
                <div class="form-group">
                    <label for="role">Role:</label>
                    <select name="role" class="form-control" v-model="role_id">
                        <option v-for="(role, index) in roles" :key="index" :value="role.id">
                            {{role.name}}
                        </option>
                    </select>
                  </div>
              </form>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="submit" class="btn btn-success"
                    @click="add"
            >Add</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
  
      </div>
    </div>
  </div>
      
</template>
<script lang="ts">
import axiosClient from '../axios';
import ErrorDisplay from './ErrorDisplay.vue';
import SuccessDisplay from './SuccessDisplay.vue';
export default {
    emits: ['addUser'],
    data(){
        return{
            fullname: '', 
            email:'',
            password: '',
            password_confirmation: '',
            role_id: '',
            roles: [],
            errors:[],
            response : ''
        }
    },
    components:{
        ErrorDisplay,
        SuccessDisplay
    },
    methods:{
        async add(){
            let user = {
                fullname:this.fullname,
                email: this.email,
                role_id:this.role_id,
                password: this.password,
                password_confirmation: this.password_confirmation
            }
            try{
                let res = await axiosClient.post('/add-user',user) as any;
                console.log(res);
                // if(res?.data?.message){
                //     console.log(res.response.data.message);
                //     this.setError(res.response.data.message);
                //     return
                // }
                console.log(res.data.user);
                this.$emit('addUser',res.data.user);
                this.refreshForm();
                this.setResponse('Successfully added user!');
            }catch(err:any){
                console.log(err); 
                this.setResponse('');
                this.setError(err);
            }
        },
        refreshForm(){
          this.fullname = '',
          this.email = '';
          this.role_id='';
          this.password = '';
          this.password_confirmation = '';
          this.setError(null);
          this.setResponse('')
        },
        setError(err:any){
            this.errors = err?.response.data.errors;
        },
        setResponse(msg:string){
          this.response = msg
        },
        async getRoles(){
          try{
            let res = await axiosClient.get('/roles');
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
    async created(){
        this.getRoles();
    }

}
</script>
<style lang="">
    
</style>