<template>
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8 login">
      <div class="w-full max-w-md space-y-8">
        <div>
          <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Sign in</h2>
          <p class="text-center">Intern exam app</p>
        </div>
        <p v-if="hasError" class="text-center">{{ error }}</p>
        <form class="mt-8 space-y-6">
          <div class="-space-y-px rounded-md shadow-sm">
            <div>
              <label for="email-address" class="sr-only">Email address</label>
              <input id="email-address" 
                name="email" type="email"
                required 
                class="relative block w-full rounded-t-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Email address" 
                v-model="email"
                />
            </div>
            <div>
              <label for="password" class="sr-only">Password</label>
              <input id="password" name="password" type="password"
               required class="relative block w-full rounded-b-md border-0 py-1.5 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:z-10 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" 
                placeholder="Password"
               v-model="password" />
            </div>
          </div>
          <div>
            <button
            class="group relative flex w-full justify-center rounded-md py-2 px-3 text-sm font-semibold text-white "
            @click.prevent="login" :disabled="!isSubmitReady"
            :class="btnDisplay">
              Sign in
            </button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script lang="ts">
  import axios from '../axios'
  import { tokenState } from '../states/TokenState';
  export default{
    data(){
      return{
         email: 'jasxyke23.jxc@gmail.com',
         password: 'passwor',
         error: '',
         loading: false
      }
    },
    computed:{
      isSubmitReady(){
        return !(!this.email || !this.password) && !this.loading;
      },
      btnDisplay(){
        return {'hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 bg-indigo-600': this.isSubmitReady,
                'bg-gray-600': !this.isSubmitReady}
      },
      hasError(){
        return this.error != '';
      }
    },
    methods:{
      async login(){
        this.loading = true;
        if(!this.email || !this.password){
            alert('please fill in the fields');
            return;
        }
        try{
          let res = await axios.post('/login',{
              email: this.email,
              password: this.password
        });
        console.log(res.status);
        
        if(res.status == 201){
          let token = res.data.token;
          console.log(res.data);
          console.log(res.statusText);
          console.log(token);
          this.setError('')
          tokenState.setToken(token)
          this.$router.push('/home')
        }else{
          this.setError(res.data.message);
        }
        }catch(err:any){
          console.log(err);
          this.setError(err);
          this.loading = false;
        }
        this.loading = false;
      },
      setError(err:any){
        this.error = err;
      }
    }
  }
  </script>

<style scoped>
  .login{
    display: flex;
    justify-content: center;
    height: 100vh;
  }
</style>