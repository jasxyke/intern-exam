import {reactive} from 'vue'

export const roleState = reactive({
    role: {
        id:0,
        name:'',
        description:'',
    },
    setRole(role: any){
        this.role = role; 
    },
    getRole(){
        return this.role;
    }
})