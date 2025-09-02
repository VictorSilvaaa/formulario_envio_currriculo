import { createRouter, createWebHistory } from 'vue-router'
import EnviarCurriculo from './pages/EnviarCurriculo.vue'

const routes = [
  {
    path: '/enviar-curriculo',
    name: 'EnviarCurriculo',
    component: EnviarCurriculo
  }
]

const router = createRouter({
  history: createWebHistory(),
  routes
})

export default router