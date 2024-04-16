<template>
    <div class="h-full bg-gray-200 flex ">
        <!--sidebar-->

            <sidebar :class="{'-ml-[200px]':!sidebarOpened}" />


        <div class="flex-1">
            <!--sidebar-->

            <Navbar @toggle-sidebar="toggleSidebar"></Navbar>
            <!--content-->

            <main class="p-6">
                <div class="p-4 rounded bg-white">
                    <router-view></router-view>
                </div>
            </main>
            <!--content-->

        </div>
    </div>

</template>

<script setup>
import { ref,onMounted,onUnmounted } from "vue";
import Sidebar from "./Sidebar.vue"
import Navbar from "./Navbar.vue";
const { title } = defineProps({
    title: String
})

const sidebarOpened = ref(true)

function toggleSidebar(){
    sidebarOpened.value = !sidebarOpened.value
}

onMounted(() => {
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
