<template lang="">
    <div class="container">
        <h2>Users</h2>
        <div class="add-box">
            <button
                class="btn add-btn"
                data-bs-toggle="modal" data-bs-target="#addUserModal"
            >Add user</button>
        </div>
        <table class="table table-striped">
            <tr>
                <th>Fullname</th>
                <th>Email</th>
                <th>Role</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <tr class="pt-5 pb-5" v-if="users.length>0" v-for="(user, index) in users" :key="index">
                <td>{{user?.fullname}}</td>
                <td>{{user?.email}}</td>
                <td>{{user?.role?.name}}</td>
                <td>
                    <button 
                        class="edit btn"
                        type="button"
                        @click="setUser(user)"
                        data-bs-toggle="modal" data-bs-target="#editUserModal"
                    >
                        Edit
                    </button>
                </td>
                <td>
                    <button class="delete btn"
                        type="button"
                        @click.prevent="deleteUser(user)"
                    >
                    Delete
                    </button>
                </td>
            </tr>
        </table>
        <!-- <UserEditForm
            id="editUserModal"
            @edit-user="editUser"
        ></UserEditForm> -->
        <AddUserForm
            id="addUserModal"
            @add-user="addUser"
        >
        </AddUserForm>
    </div>
</template>
<script lang="ts">
import { defineComponent } from 'vue';
import axiosClient from '../axios';
import UserEditForm from '../components/UserEditForm.vue';
import AddUserForm from '../components/AddUserForm.vue';
import {computed} from 'vue';

export default defineComponent({
    components:{
        //UserEditForm,
        AddUserForm
    },
    data(){
        return{
            user: {},
            users: [{ 
                fullname: 'unknown', 
                email:'unknonw',
                role:{
                    name:''
                }
            }],
        }
    },
    created(){
        this.getUsers();
    },
    provide(){
        return{
            user: computed(()=>this.user)
        }
    },
    methods:{
        setUser(userObj:any){
            console.log(userObj);
            //userState.setuser(user);
            this.user = userObj;
        },
        async addUser(user:any){
            console.log(user);
            
            try{
                let res = await axiosClient.post('/add-user',user);
                console.log(res.status);
                if(res.status == 201){
                    console.log(res.data.user);
                    this.users.push(res.data.user);
                }else{
                    console.log(res.data.message);
                }
            }catch(err){
                console.log(err); 
            }
        },
        async editUser(user:any){
            try{
                let res = await axiosClient.put(`/users/${user.id}`,
                {
                    name: user.name,
                    email: user.email
                });
                if(res.status == 200){
                    console.log('user:',res.data);
                }else{
                    console.log(res.data.message);
                    
                }

            }catch(err){
                console.log(err);    
            }
        },
        async deleteUser(user:any){
            try{
                let res = await axiosClient.delete('/users/'+user.id);
                if(res.status == 200 || res.status == 204){
                    console.log('deleted: ');
                    console.log(res.data);
                    this.users = this.users.filter((userItem:any)=>{
                        return userItem.id !== user.id;
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
        async getUsers(){
            try{
            const res = await axiosClient.get('/users');
            console.log('getting users...');
            if(res.status == 200){
                let users = res.data;
                console.log(users);
                this.users = users;
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