import axios from 'axios'

const axiosClient = axios.create({
    //baseURL: import.meta.env.EXAM_API_BASE_URL + '/api',
    baseURL: 'http://127.0.0.1:8000' + '/api',
    headers: {
        'Content-Type': 'application/json'
    }
})

axiosClient.interceptors.request.use((config) => {
    let token = localStorage.getItem('token')
    if (token != null) token = JSON.parse(token)
    config.headers.Authorization = 'Bearer ' + token
    return config
})

axiosClient.interceptors.response.use((res) => res, err => {
    if (err.response && err.response.status === 401) {
        localStorage.clear();
        //window.location.reload()
        // routes.navigate('/login')
        return err
    } throw err
})


export default axiosClient;