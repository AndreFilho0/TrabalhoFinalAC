<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            Bem vindo, vamos te ajudar a montar o seu PC
          </div>
        </div>
      </div>
    </div>

    <div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
      <h1 class="text-2xl font-semibold mb-4 text-center">Formulário de Avaliação</h1>

      <form @submit.prevent="submitForm">
        <!-- Consumo de Energia -->
        <div class="mb-4">
          <label for="energia" class="block text-sm font-medium text-gray-700">Consumo de Energia</label>
          <input 
            v-model="form.energia" 
            type="text" 
            id="energia" 
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
            required
          >
        </div>

        <!-- Desempenho -->
        <div class="mb-4">
          <label for="desempenho" class="block text-sm font-medium text-gray-700">Desempenho</label>
          <input 
            v-model="form.desempenho" 
            type="text" 
            id="desempenho" 
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
            required
          >
        </div>

        <!-- Custo -->
        <div class="mb-4">
          <label for="custo" class="block text-sm font-medium text-gray-700">Custo</label>
          <input 
            v-model="form.custo" 
            type="number" 
            id="custo" 
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
            required
          >
        </div>

        <!-- Tipo de Aplicação -->
        <div class="mb-4">
          <label for="aplicacao" class="block text-sm font-medium text-gray-700">Tipo de Aplicação</label>
          <input 
            v-model="form.aplicacao" 
            type="text" 
            id="aplicacao" 
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
            required
          >
        </div>

        <div class="mt-6">
          <button 
            type="submit" 
            class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          >
            Enviar
          </button>
        </div>
      </form>

      <!-- Resposta da API renderizada como Markdown -->
      <div v-if="responseData" class="mt-8 bg-gray-100 p-4 rounded-md shadow-md">
        <h2 class="text-lg font-medium text-gray-700">Recomendação:</h2>
        <div class="mt-2 text-sm text-gray-600" v-html="formattedMarkdown"></div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { marked } from 'marked';

const form = useForm({
  energia: '',
  desempenho: '',
  custo: '',
  aplicacao: '',
});

const responseData = ref('');

const submitForm = async () => {
  await form.post('/api/avaliacao', {
    onSuccess: (page) => {
      responseData.value = page.props.response; 
    },
    onError: (errors) => {
      console.error('Erro:', errors);
    },
  });
};


const formattedMarkdown = computed(() => {
  return responseData.value ? marked(responseData.value) : '';
});
</script>
