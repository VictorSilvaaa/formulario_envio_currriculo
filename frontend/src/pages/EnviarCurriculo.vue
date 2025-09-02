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
            label="Telefone"
            :error-messages="erroTelefone"
            prepend-inner-icon="mdi-phone"
            required
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
import { ref } from 'vue'
import { useField, useForm } from 'vee-validate'
import Swal from 'sweetalert2'
import { enviarCurriculo } from '@services/curriculoService'
import { Curriculo } from '@types/curriculo'
import { curriculoSchema } from '@/schemas/curriculoSchema'

// useForm do VeeValidate
const { validate, resetForm } = useForm<Curriculo>({
  validationSchema: curriculoSchema,
})

// Campos com useField
const { value: nome, errorMessage: erroNome } = useField<string>('nome')
const { value: email, errorMessage: erroEmail } = useField<string>('email')
const { value: telefone, errorMessage: erroTelefone } = useField<string>('telefone')
const { value: cargoDesejado, errorMessage: erroCargoDesejado } = useField<string>('cargoDesejado')
const { value: escolaridade, errorMessage: erroEscolaridade } = useField<string>('escolaridade')
const { value: observacoes } = useField<string>('observacoes')
const { value: arquivo, errorMessage: erroArquivo } = useField<File | null>('arquivo')

const loading = ref(false)
const formRef = ref()
const escolaridadeOptions = ['Fundamental', 'Médio', 'Superior', 'Pós-graduação']

// Função chamada no submit
const submitForm = async () => {
  const result = await validate() // valida todos os campos

  if (!result.valid) {
    // Se houver erros, mostra Swal e os erros aparecem nos campos automaticamente
    Swal.fire({
      title: 'Campos inválidos',
      text: 'Por favor, verifique os campos e preencha corretamente.',
      icon: 'warning',
      showCloseButton: true,
      timer: 3000,
    })
    return
  }

  // Se todos os campos forem válidos, envia o formulário
  const dados: Curriculo = {
    nome: nome.value,
    email: email.value,
    telefone: telefone.value,
    cargoDesejado: cargoDesejado.value,
    escolaridade: escolaridade.value,
    observacoes: observacoes.value,
    arquivo: arquivo.value,
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
      text: 'Currículo enviado com sucesso! Uma cópia foi enviada para seu e-mail.',
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
