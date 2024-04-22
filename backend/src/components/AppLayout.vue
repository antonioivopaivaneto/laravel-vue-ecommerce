<template>
    <div v-if="currentUser.id" class="h-full bg-gray-200 flex ">
        <!--sidebar-->

            <sidebar :class="{'-ml-[200px]':!sidebarOpened}" />


        <div class="flex-1">
            <!--sidebar-->

            <Navbar @toggle-sidebar="toggleSidebar"></Navbar>
            <!--content-->

            <main class="p-6">
                    <router-view ></router-view>
            </main>
            <!--content-->

        </div>
    </div>
    <div v-else class="min-h-full bg-gray-200 flex items-center justify-center">
        <Spinner />

    </div>


</template>

<script setup>
import { ref,onMounted,onUnmounted, computed } from "vue";
import Sidebar from "./Sidebar.vue"
import Navbar from "./Navbar.vue";
import store from "../store";
import Spinner from "./core/Spinner.vue";
const { title } = defineProps({
    title: String
})

const sidebarOpened = ref(true)

const currentUser = computed(() => store.state.user.data)

function toggleSidebar(){
    sidebarOpened.value = !sidebarOpened.value
}

onMounted(() => {
    store.dispatch('getUser')
    handleSidebarOpened()
    window.addEventListener('resize',handleSidebarOpened)
})
onUnmounted(() => {
    window.removeEventListener('resize',handleSidebarOpened)

});

function handleSidebarOpened(){

    sidebarOpened.value = window.outerWidth > 768;

    /*if(window.outerWidth<=768){
        sidebarOpened.value = false
    }else{
        sidebarOpened.value = true

    }
    */
}
</script>
