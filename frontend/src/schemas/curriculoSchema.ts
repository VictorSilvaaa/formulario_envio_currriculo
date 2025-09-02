import * as yup from 'yup'

const EXTENSOES_PERMITIDAS = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']

export const curriculoSchema = yup.object({
  nome: yup.string()
    .required('Nome é obrigatório')
    .min(3, 'Nome deve ter pelo menos 3 caracteres'),
  email: yup.string()
    .email('E-mail inválido')
    .required('E-mail é obrigatório'),
  telefone: yup.string()
    .required('Telefone é obrigatório')
    .matches(/^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$/, 'Telefone inválido'),
  cargoDesejado: yup.string()
    .required('Cargo desejado é obrigatório')
    .min(2, 'Cargo desejado deve ter pelo menos 2 caracteres'),
  escolaridade: yup.string()
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
  dataHoraEnvio: yup.string().required(),
})