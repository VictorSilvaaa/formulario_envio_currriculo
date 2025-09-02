import { Curriculo } from '@/types/curriculo'
import { api } from './apiService'

export async function enviarCurriculo(dados: Curriculo) {
  const formData = new FormData()
  Object.entries(dados).forEach(([key, value]) => {
    formData.append(key, value as any)
  })
  return api.post('/curriculos', formData)
}