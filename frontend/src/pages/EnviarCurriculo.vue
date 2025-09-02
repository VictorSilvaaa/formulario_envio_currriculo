<template>
  <VContainer class="py-8" max-width="600">
    <VCard>
      <VCardTitle class="minha-classe-css">
        <VIcon class="mr-2" color="primary">mdi-file-send</VIcon>
        Enviar Currículo
      </VCardTitle>
      <VCardText>
        <VForm ref="formRef" @submit.prevent="submitForm">
          <VTextField
            v-model="nome"
            label="Nome"
            :error-messages="erroNome"
            prepend-inner-icon="mdi-account"
            required
          />
          <VTextField
            v-model="email"
            label="E-mail"
            :error-messages="erroEmail"
            prepend-inner-icon="mdi-email"
            required
          />
          <VTextField
            v-model="telefone"
            label="Telefone/Celular"
            :error-messages="erroTelefone"
            prepend-inner-icon="mdi-phone"
            required
            @input="onTelefoneInput"
            maxlength="15"
            placeholder="(99) 99999-9999"
          />
          <VTextField
            v-model="cargoDesejado"
            label="Cargo Desejado"
            :error-messages="erroCargoDesejado"
            prepend-inner-icon="mdi-briefcase"
            required
          />
          <VSelect
            v-model="escolaridade"
            :items="escolaridadeOptions"
            label="Escolaridade"
            :error-messages="erroEscolaridade"
            prepend-inner-icon="mdi-school"
            item-title="titulo"
            item-value="id"
            required
          />
          <VTextarea
            v-model="observacoes"
            label="Observações"
            prepend-inner-icon="mdi-note-text"
            rows="2"
            auto-grow
          />
          <VFileInput
            v-model="arquivo"
            label="Arquivo (.pdf, .doc, .docx) - Máximo 1MB"
            :error-messages="erroArquivo"
            accept=".pdf,.doc,.docx"
            required
            show-size
            counter
          >
            <template v-slot:prepend-inner>
              <VIcon class="text-grey-darken-1">mdi-paperclip</VIcon>
            </template>
          </VFileInput>
          <VBtn
            :loading="loading"
            color="primary"
            type="submit"
            block
            class="mt-4"
            prepend-icon="mdi-send"
          >
            Enviar
          </VBtn>
        </VForm>
      </VCardText>
    </VCard>
  </VContainer>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useField, useForm } from 'vee-validate'
import Swal from 'sweetalert2'
import { enviarCurriculo } from '@/services/curriculoService'
import { Curriculo } from '@/types/curriculo'
import { curriculoSchema } from '@/schemas/curriculoSchema'
import { buscarOpcoesEscolaridades } from '@/services/OpcoesService'

// useForm do VeeValidate
const { validate, resetForm } = useForm<Curriculo>({
  validationSchema: curriculoSchema,
})

// Campos com useField
const { value: nome, errorMessage: erroNome } = useField<string>('nome')
const { value: email, errorMessage: erroEmail } = useField<string>('email')
const { value: telefone, errorMessage: erroTelefone } = useField<string>('telefone')
const { value: cargoDesejado, errorMessage: erroCargoDesejado } = useField<string>('cargo_desejado')
const { value: escolaridade, errorMessage: erroEscolaridade } = useField<number>('escolaridade_id')
const { value: observacoes } = useField<string>('observacoes')
const { value: arquivo, errorMessage: erroArquivo } = useField<File | null>('arquivo')

const loading = ref(false)
const formRef = ref()
const escolaridadeOptions = ref<{ id: number; titulo: string }[]>([])

// Carregar opções de escolaridade do backend
onMounted(async () => {
  try {
    const { data } = await buscarOpcoesEscolaridades()
    escolaridadeOptions.value = data
  } catch (err) {
    console.error('Erro ao buscar escolaridades:', err)
    Swal.fire({
      title: 'Erro',
      text: 'Falha ao carregar opções de escolaridade.',
      icon: 'error',
      showCloseButton: true,
      timer: 4000,
    })
  }
})

// Máscara para telefone brasileiro (com DDD)
function onTelefoneInput(e: Event) {
  let valor = (e.target as HTMLInputElement).value.replace(/\D/g, '')
  if (valor.length > 11) valor = valor.slice(0, 11)
  if (valor.length >= 2) {
    valor = valor.replace(/^(\d{2})(\d*)/, '($1) $2')
    if (valor.replace(/\D/g, '').length === 11) {
      valor = valor.replace(/^(\(\d{2}\)\s)(\d{5})(\d{4})$/, '$1$2-$3')
    } else if (valor.replace(/\D/g, '').length === 10) {
      valor = valor.replace(/^(\(\d{2}\)\s)(\d{4})(\d{4})$/, '$1$2-$3')
    }
  }
  telefone.value = valor
}

// Função chamada no submit
const submitForm = async () => {
   const result = await validate()

  if (!result.valid) {
    // Extrai os erros de cada campo
    const mensagensErros = Object.values(result.errors).flat().join('\n')

    Swal.fire({
      title: 'Campos inválidos',
      html: mensagensErros.replace(/\n/g, '<br>'), // converte quebras de linha em <br> para HTML
      icon: 'warning',
      showCloseButton: true,
      timer: 5000,
    })
    return
  }

  // Cria objeto tipado
  const dados: Curriculo = {
    nome: nome.value,
    email: email.value,
    telefone: telefone.value.replace(/\D/g, ''),
    cargo_desejado: cargoDesejado.value,
    escolaridade_id: escolaridade.value,
    observacoes: observacoes.value,
    arquivo: arquivo.value!,
  }

  try {
    loading.value = true
    Swal.fire({
      title: 'Enviando...',
      allowOutsideClick: false,
      didOpen: () => Swal.showLoading(),
    })

    await enviarCurriculo(dados)

    Swal.close()
    Swal.fire({
      title: 'Sucesso',
      text: 'Currículo enviado com sucesso! Um e-mail de confirmação da sua inscrição foi enviado.',
      icon: 'success',
      showCloseButton: true,
      timer: 3000,
    })

    resetForm()
  } catch (err) {
    Swal.close()
    Swal.fire({
      title: 'Erro',
      text: 'Falha ao enviar currículo.',
      icon: 'error',
      showCloseButton: true,
      timer: 4000,
    })
  } finally {
    loading.value = false
  }
}
</script>

<style scoped>
::v-deep(.v-file-input .v-input__prepend) {
  display: none !important;
}
</style>