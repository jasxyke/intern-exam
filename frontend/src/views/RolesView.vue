<template lang="">
    <div class="container">
        <h2>Roles</h2>
        <div class="add-box">
            <button
                class="btn btn-success"
                data-bs-toggle="modal" data-bs-target="#addRoleModal"
            >Add role</button>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr class="pt-5 pb-5" v-if="roles.length>0" v-for="(role, index) in roles" :key="index">
                <td>{{role.id}}</td>
                <td>{{role.name}}</td>
                <td>{{role.description}}</td>
                <td>
                    <button 
                        class="btn btn-info"
                        type="button"
                        @click="setRole(role)"
                        data-bs-toggle="modal" data-bs-target="#editRoleModal"
                    >
                        Edit
                    </button>
                </td>
                <td>
                    <button class="btn btn-danger"
                        type="button"
                        @click.prevent="deleteRole(role)"
                    >
                    Delete
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
        <RoleEditForm
            id="editRoleModal"
            @edit-role="editRole"
        ></RoleEditForm>
        <AddRoleForm
            id="addRoleModal"
            @add-role="addRole"
        >
        </AddRoleForm>

    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import axiosClient from '../axios';
import RoleEditForm from '../components/RoleEditForm.vue'
import AddRoleForm from '../components/AddRoleForm.vue';
import { roleState } from '../states/RoleState';
export default defineComponent({
    components:{
        RoleEditForm,
        AddRoleForm,
    },
    data(){
        return{
            role: {id:'', name: 'roleSample', description:'descriptSample'},
            roles: [{id:'', name: 'roleSample', description:'descriptSample'}],
        }
    },
    created(){
        this.getRoles();
    },
    methods:{
        setRole(roleObj:any){
            console.log(roleObj);
            roleState.role.id = roleObj.id;
            roleState.role.name = roleObj.name;
            roleState.role.description = roleObj.description;
        },
        async addRole(role:any){
            this.roles.push(role);
        },
        async editRole(role:any){
            let roleIndex = this.roles.findIndex((roleItem)=>{
                return roleItem.id === role.id;
            })
            this.roles[roleIndex] = role;
        },
        async deleteRole(role:any){
            try{
                let res = await axiosClient.delete('/roles/'+role.id);
                if(res.status == 200 || res.status == 204){
                    console.log('deleted: ');
                    console.log(res.data);
                    this.roles = this.roles.filter((roleItem:any)=>{
                        return roleItem.id !== role.id;
                    }   
                )
                }else{
                    console.log(res.data);
                    console.log(res.status);
                    
                }
            }catch(err:any){
                console.log(err.data.message);
            }
        },
        async getRoles(){
            try{
            const res = await axiosClient.get('/roles');
            console.log('getting roles...');
            if(res.status == 200){
                let roles = res.data;
                console.log(roles);
                this.roles = roles;
            }else{
                console.log(res);   
            }
            
            
        }catch(err){
            console.log(err);    
        }
        }
    }
});
</script>
<style scoped>
    .delete{
        background-color: red;
        color:white;
    }
    .edit{
        background-color:aquamarine;
    }
    .add-box{
        text-align: right;
    }
    .add-btn{
        background-color: yellowgreen;
    }
</style>