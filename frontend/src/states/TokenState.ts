import {reactive} from 'vue'

export const userState = reactive({
    token: '',
    setToken(tokenStr: string){
        this.token = tokenStr;
    },
    getToken(){
        return this.token;
    }
})