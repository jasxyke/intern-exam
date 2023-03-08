import {reactive} from 'vue'

export const userState = reactive({
    user: {
        id:0,
        fullname:'',
        email:'',
        role_id:0
    },
    setUser(userObj: any){
        this.user = userObj; 
    },
    getUser(){
        return this.user;
    }
})