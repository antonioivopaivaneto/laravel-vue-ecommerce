<template>

    <div class="flex items-center justify-between mb-5">
        <h1 class="text-3xl font-semibold">Products</h1>
        <button type="submit"
        @click="showProductModal"
            class="flex  justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add
            new Products</button>

    </div>
    <ProductModal :product="ProductModel" v-model="ShowModal" @close="onModelClose" />
    <ProductsTable @clickEdit="EditProduct" />



</template>


<script setup>
import { computed, onMounted, ref } from 'vue';
import store from '../../store';
import { PRODUCTS_PER_PAGE } from '../../constants.js'
import ProductsTable from './ProductsTable.vue';
import ProductModal from './ProductModal.vue';


const ShowModal = ref(false)

const DEFAULT_EMPTY_OBJECT ={
    id:'',
    title:'',
    image:'',
    description:'',
    price:'',
}
const ProductModel = ref({...DEFAULT_EMPTY_OBJECT})

function showProductModal(){
    ShowModal.value = true

}

function EditProduct(product){
    store.dispatch('getProduct', product.id)
    .then(({data}) => {
        ProductModel.value = data
        showProductModal()
    })

}

function onModelClose(){
    ProductModal.value = {...DEFAULT_EMPTY_OBJECT} ;
}


</script>

<style scoped></style>
