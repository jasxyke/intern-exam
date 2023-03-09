import {reactive} from 'vue'

export const tokenState = reactive({
    setToken(token: string){
        localStorage.setItem('token', JSON.stringify(token))
    },
    getToken(){
        let token = localStorage.getItem('token');
        if (token != null) {
            return JSON.parse(token)
        }
        return null;
    }
})