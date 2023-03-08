import {reactive} from 'vue'

export const userState = reactive({
    user: {},
    setUser(userObj: object){
        this.user = userObj; 
    },
    getUser(){
        return this.user;
    }
})