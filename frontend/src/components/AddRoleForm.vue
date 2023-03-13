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
          <ErrorDisplay
            v-if="errors != null"
            :errors="errors"
          ></ErrorDisplay>
          <SuccessDisplay
            v-if="response!==''"
            :message="response"
          ></SuccessDisplay>
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
            <button type="button" class="btn btn-success"
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
    emits: ['addRole'],
    data(){
        return{
            name: '',
            description: '',
            errors:null,
            response:''
        }
    },
    components:{
      ErrorDisplay,
      SuccessDisplay
    },
    methods:{
        async add(){
            let role = {
                name:this.name,
                description: this.description
            }
            try{
                let res = await axiosClient.post('/add-role',role);
                console.log(res.data);
                this.$emit('addRole',res.data);
                this.refreshForm();
                this.setResponse('Sucessfully added role');
            }catch(err){
                console.log(err);
                this.refreshForm();
                this.setError(err);
            }
        },
        refreshForm(){
          this.name = '',
          this.description = '';
          this.setError(null);
          this.setResponse('');
        },
        setError(err:any){
          this.errors = err?.response.data.errors;
        },
        setResponse(msg:string){
          this.response = msg;
        }
    }

}
</script>
<style lang="">
    
</style>