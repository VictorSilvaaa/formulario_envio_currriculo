import { api } from './apiService'

export async function buscarOpcoesEscolaridades() {
  return api.get('/escolaridades')
}
