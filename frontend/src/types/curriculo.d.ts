export interface Curriculo {
  nome: string
  email: string
  telefone: string
  cargoDesejado: string
  escolaridade: string
  observacoes: string
  arquivo: File | null
}