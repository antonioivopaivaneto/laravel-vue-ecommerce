<template>
    <th @click="emit('click', field)" class="border-b-2 p-2 text-left cursor-pointer bg-gray-100"
        :class="field === sortField ? 'bg-blue-50' : ''">
        <div class="flex justify-between">
            <slot></slot>
            <div v-if="sortField === field" class="ml-2">
                <!--sort Asc-->
                <svg v-if="sortDirection === 'asc'" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd"
                        d="M11.47 2.47a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06l-6.22-6.22V21a.75.75 0 0 1-1.5 0V4.81l-6.22 6.22a.75.75 0 1 1-1.06-1.06l7.5-7.5Z"
                        clip-rule="evenodd" />
                </svg>
                <!--sort Desc-->
                <svg v-else xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd"
                        d="M12 2.25a.75.75 0 0 1 .75.75v16.19l6.22-6.22a.75.75 0 1 1 1.06 1.06l-7.5 7.5a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 1 1 1.06-1.06l6.22 6.22V3a.75.75 0 0 1 .75-.75Z"
                        clip-rule="evenodd" />
                </svg>


            </div>
        </div>
    </th>

</template>

<script setup>

const { field, sortField, sortDirection } = defineProps({
    field: String,
    sortField: String,
    sortDirection: String,
})

const emit = defineEmits(['click'])


</script>
