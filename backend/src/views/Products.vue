<template>

  <div class="flex items-center justify-between mb-3">
    <h1 class="text-3xl font-semibold">Products</h1>
    <button type="submit"
                    class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add new Products</button>
   </div>
   <div class="bg-white p-4 rounded-lg shadow">
     <div class="flex justify-between border-b-2 pb-3">
        <div class="flex items-center">
            <span class="whitespace-nowrap mr-3">Per Page</span>
            <select v-model="perPage" @change="getProducts(null)" class="appearance-none relative block w-24 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm-text-sm">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>
        </div>
        <div>
            <input v-model="search" @change="getProducts(null)" class="appearance-none relative block w-24 px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm-text-sm" placeholder="Type to Search products" >
        </div>
     </div>
     <spinner v-if="products.loading" />
     <template v-else>
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <th class="border-b2-2 p-2 text-left">ID</th>
                    <th class="border-b2-2 p-2 text-left">Image</th>
                    <th class="border-b2-2 p-2 text-left">Title</th>
                    <th class="border-b2-2 p-2 text-left">Price</th>
                    <th class="border-b2-2 p-2 text-left">Last Updated At</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="product of products.data" :key="product.id">
                    <td class="border-b p-2"> {{ product.id }}</td>
                    <td class="border-b p-2">
                        <img :src="product.image" class="w-16" alt="product.title">
                    </td>
                    <td class="border-b p-2 max-w-[200px] whitespace-nowrap overflow-hidden text-ellipsis">
                        {{ product.title }}
                    </td>
                    <td class="border-b p-2">
                        {{ product.price }}
                    </td>
                    <td class="border-b p-2">
                        {{ product.updated_at }}
                    </td>
                </tr>
            </tbody>

        </table>
        <div class="flex justify-between items-center mt-5">
            <span>
                Showing from {{ products.from }} tp {{ products.to }}
            </span>
            <nav
            v-if="products.total > products.limit"
            class="relative z-0 inline-flex justify-center rounded-md shadow-sm -space-x-px" aria-label="PAgination">

            <a v-for="(link, i ) of products.links" :key="i" :disabled="!link.url" href="#" @click.prevent="getForPage($event, link)" aria-current="page"
            class="relative inline-flex items-center px-4 py-2 border-sm font-medium whitespace-nowrap"
            v-html="link.label" :class="[link.active ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600':'bg-white border-gray-300 text-gray-500 hover:bg-gray-50',
                i === 0 ? 'rounded-l-md' : '',
                i === products.links.length -1 ? 'rounded-r-md' : '',
                !link.url ? 'bg-gray-100 text-gray-700':''
            ]"></a>


        </nav>

        </div>

     </template>
   </div>
</template>


<script setup>
import { computed, onMounted, ref } from 'vue';
import Spinner from '../components/core/Spinner.vue';
import store from '../store';
import {PRODUCTS_PER_PAGE} from '../constants.js'

const perPage = ref(PRODUCTS_PER_PAGE)
const search = ref('')
const products = computed(() => store.state.products)


onMounted(() =>{
    getProducts();
})

function getProducts(url = null){
    store.dispatch('getProducts',{
        url,
        search: search.value,
        perPage:perPage.value
    })
}

function getForPage(ev, link){

    if(!link.url || link.active){
        return
    }

    getProducts(link.url)
}
</script>

<style scoped></style>
