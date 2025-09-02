export interface Curriculo {
  nome: string
  email: string
  telefone: string
  cargo_desejado: string
  escolaridade_id: string
  observacoes: string
  arquivo: File | null
}