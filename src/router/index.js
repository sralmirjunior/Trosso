import { createRouter, createWebHistory } from '@ionic/vue-router';
import home from '../views/Home.vue';
import board from '../views/Board.vue';
import notFound from '../views/404.vue'

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
    path: '/board/:id/:name',
    name: 'board',
    component: board,
  },
  { path: '/404', component: notFound },
  { path: '/:catchAll(.*)', redirect: '/404' },

]
const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
