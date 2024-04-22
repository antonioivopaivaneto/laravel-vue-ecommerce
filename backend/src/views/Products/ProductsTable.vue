<template>




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
        <table class="table-auto w-full">
            <thead>
                <tr>
                    <TableHeadingCell @click="sortProduct" class="border-b2-2 p-2 text-left" field="id" :sort-field="sortField" :sort-direction="sortDirection">ID</TableHeadingCell>
                    <TableHeadingCell  class="border-b2-2 p-2 text-left" field="" :sort-field="sortField" :sort-direction="sortDirection">Image</TableHeadingCell>
                    <TableHeadingCell @click="sortProduct" class="border-b2-2 p-2 text-left" field="title" :sort-field="sortField" :sort-direction="sortDirection">Title</TableHeadingCell>
                    <TableHeadingCell @click="sortProduct" class="border-b2-2 p-2 text-left" field="price" :sort-field="sortField" :sort-direction="sortDirection">Price</TableHeadingCell>
                    <TableHeadingCell @click="sortProduct" class="border-b2-2 p-2 text-left" field="updated_at" :sort-field="sortField" :sort-direction="sortDirection">Last Updated At</TableHeadingCell>
                </tr>
            </thead>
            <tbody v-if="products.loading">
            <tr>
                <td colspan="5">
                    <spinner v-if="products.loading" class="my-4 " />

                </td>
            </tr>
        </tbody>
            <tbody v-else>
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
        <div v-if="!products.loading" class="flex justify-between items-center mt-5">
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

   </div>
</template>


<script setup>
import { computed, onMounted, ref } from 'vue';
import Spinner from '../../components/core/Spinner.vue';
import store from '../../store';
import {PRODUCTS_PER_PAGE} from '../../constants.js'
import TableHeadingCell from '../../components/core/table/TableHeadingCell.vue';

const perPage = ref(PRODUCTS_PER_PAGE)
const search = ref('')
const products = computed(() => store.state.products)
const sortField = ref('updated_at')
const sortDirection = ref('desc')

onMounted(() =>{
    getProducts();
})

function getProducts(url = null){
    store.dispatch('getProducts',{
        url,
        sort_field:sortField.value,
        sort_direction:sortDirection.value,
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


function sortProduct(field){
    if(sortField.value === field){
        if(sortDirection.value === 'asc'){
        sortDirection.value = 'desc'

    }else{
        sortDirection.value = 'asc'
    }
    }else{

        sortField.value = field
        sortDirection.value = 'asc'

    }

    getProducts();



}
</script>

<style scoped></style>
