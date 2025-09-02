import * as yup from 'yup'

const EXTENSOES_PERMITIDAS = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']

export const curriculoSchema = yup.object({
  nome: yup.string()
    .required('Nome é obrigatório')
    .min(3, 'Nome deve ter pelo menos 3 caracteres'),
  email: yup.string()
    .email('E-mail inválido')
    .required('E-mail é obrigatório'),
  telefone: yup
    .string()
    .required('Telefone é obrigatório')
    .transform((value) => {
      if (!value) return value

      // mantém só números
      let somenteNumeros = value.replace(/\D/g, '')

      // remove os 2 primeiros dígitos (DDD)
      if (somenteNumeros.length > 2) {
        somenteNumeros = somenteNumeros.slice(2)
      }

      return somenteNumeros
    })
    .matches(/^\d{8,9}$/, 'Telefone deve ter 8 ou 9 dígitos'),
  cargo_desejado: yup.string()
    .required('Cargo desejado é obrigatório')
    .min(2, 'Cargo desejado deve ter pelo menos 2 caracteres'),
  escolaridade_id: yup.number()
    .required('Escolaridade é obrigatória'),
  observacoes: yup.string()
    .max(500, 'Observações deve ter no máximo 500 caracteres'),
  arquivo: yup
    .mixed()
    .required('Arquivo é obrigatório')
    .test('fileType', 'Arquivo deve ser .doc, .docx ou .pdf', (value: File) => {
      if (!value) return false
      return EXTENSOES_PERMITIDAS.includes(value.type)
    })
    .test('fileSize', 'Arquivo deve ter no máximo 1MB', (value: File) => {
      if (!value) return false
      return value.size <= 1024 * 1024
    }),
})