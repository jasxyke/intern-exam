<template lang="">
    <div class="container">
        <h2>Users</h2>
        <div class="add-box">
            <button
                class="btn btn-success"
                data-bs-toggle="modal" data-bs-target="#addUserModal"
            >Add user</button>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>Fullname</th>
                <th>Email</th>
                <th>Role</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr class="pt-5 pb-5" v-if="users.length>0" v-for="(user, index) in users" :key="index">
                <td>{{user?.fullname}}</td>
                <td>{{user?.email}}</td>
                <td>{{user?.role?.name}}</td>
                <td>
                    <button 
                        class="btn-primary btn"
                        type="button"
                        @click="setUser(user)"
                        data-bs-toggle="modal" data-bs-target="#editUserModal"
                    >
                        Edit
                    </button>
                </td>
                <td>
                    <button class="btn-danger btn"
                        type="button"
                        @click.prevent="deleteUser(user)"
                    >
                    Delete
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
        <UserEditForm
            id="editUserModal"
            @edit-user="editUser"
        ></UserEditForm>
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
import { userState } from '../states/EditUserState';

export default defineComponent({
    components:{
        UserEditForm,
        AddUserForm
    },
    data(){
        return{
            user: {},
            users: [{ 
                id:'',
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
            userState.user.id = userObj.id;
            userState.user.fullname = userObj.fullname;
            userState.user.email = userObj.email;
            userState.user.role_id = userObj.role_id;        
        },
        async addUser(user:any){
            console.log(user);
            this.users.push(user);
        },
        async editUser(user:any){
            let userIndex = this.users.findIndex((userItem)=>{
                return userItem.id === user.id;
            })
            this.users[userIndex] = user;
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