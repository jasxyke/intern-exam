import {reactive} from 'vue'

export const tokenState = reactive({
    token: '',
    setToken(tokenStr: string){
        this.token = tokenStr;
        localStorage.setItem('token', JSON.stringify(this.token))
    },
    getToken(){
        return this.token;
    }
})