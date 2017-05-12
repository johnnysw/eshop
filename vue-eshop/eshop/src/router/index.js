import Vue from 'vue'
import Router from 'vue-router'
import Hello from '@/components/Index'
import ProductDetail from '@/components/Detail'
import Cart from '@/components/Cart'
Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'Hello',
      component: Hello
    },
    {
    	path:'/detail/:id',
    	name:'detail',
    	component:ProductDetail
    },
    {
		path:'/cart',
    	name:'cart',
    	component:Cart
    }
  ]
})
