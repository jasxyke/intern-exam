import {reactive} from 'vue'

export const roleState = reactive({
    role: {id:0, name:'', description: ''},
    setRole(roleObj: any){
        this.role.id=roleObj.id;
        this.role.name=roleObj.name;
        this.role.description=roleObj.description;
        
    },
})