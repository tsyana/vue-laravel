import Vue from 'vue'
import Router from 'vue-router'
import Hello from '@/components/Hello'
import Test from '../views/test'
import GetPassword from '../views/get-password'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Hello',
      component: Hello
    },{
      component:Test,
      path: '/test'
    },{
      component:GetPassword,
      path:'/get-password'
    }
  ]
})
