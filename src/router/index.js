import { createRouter, createWebHistory } from '@ionic/vue-router';
import home from '../views/Home.vue';
import board from '../views/Board.vue'

const routes = [
  {
    path: '/',
    redirect: '/home'
  },
  {
    path: '/home',
    name: 'Home',
    component: home
  },
  {
    path: '/board/:id',
    name: 'board',
    component: board
  }

]
const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
