import {createRouter, createWebHashHistory} from 'vue-router';

import LoginView from './views/LoginView.vue'
import HomeView from './views/HomeView.vue'
import UsersView from './views/UsersView.vue'
import RolesView from './views/RolesView.vue';
import BaseView from './views/BaseView.vue';

const router = createRouter({
    history: createWebHashHistory(),
    routes:[
        {path: '/login', component: LoginView},
        {
            path:'', component: BaseView,
            children:[
                {path: '/home', component: HomeView},
                {path: '/users', component: UsersView},
                {path: '/roles', component: RolesView},
            ]
        }
    ],
    linkActiveClass:"bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium"
})

export default router;

// <router-link to='/home' class="nav-link">Home</router-link>
// <router-link to='/users' class="nav-link">Users</router-link>
// <router-link to='/roles' class="nav-link">Roles</router-link>