<template>

    <table class="table-sm">
        <tbody>
            <tr>
                <td class="font-bold">Order #</td>
                <td>{{ order.id }}</td>
            </tr>
            <tr>
                <td class="font-bold">Order Date</td>
                <td>{{ order.created_at }}</td>
            </tr>
            <tr>
                <td class="font-bold">Status</td>
                <td>
                    <span class=" text-white p-1 rounded {{ order.isPaid() ? 'bg-emerald-500' : 'bg-gray-500' }}">
                        {{ order.status }}
                    </span>
                </td>
            </tr>
            <tr>
                <td class="font-bold">SubTotal</td>
                <td>R${{ order.total_price }}</td>
            </tr>
        </tbody>
    </table>

</template>


<script setup>
import { computed, onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import store from '../../store';
import OrdersTable from './OrdersTable.vue';



const route = useRoute();
const order = ref({})
onMounted(() => {
    store.dispatch('getOrder', route.params.id)
        .then(data => {
            order.value = data
        })
})

</script>

<style scoped></style>
