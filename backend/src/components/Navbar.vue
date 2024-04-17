<template>
<header class="flex items-center justify-between h-14 p-3 shadow bg-white">
<button @click="emit('toggle-sidebar')" class="flex items-center justify-center rounded transition-colors w-8 h-8 text-gray-700 hover:bg-black/10" >
    <MenuIcon class="w-6" />
</button>
<div class="px-4">
    <Menu as="div" class="relative inline-block text-left">
        <MenuButton
          class="flex items-center "
        >
          <img class="rounded-full w-8 mr-2" src="https://randomuser.me/api/portraits/men/19.jpg" alt="">
         <small>{{ currentUser.name }}</small>
          <ChevronDownIcon
            class=" h-5 w-5 text-indigo-200 hover:text-indigo-100"
            aria-hidden="true"
          />
        </MenuButton>

      <transition
        enter-active-class="transition duration-100 ease-out"
        enter-from-class="transform scale-95 opacity-0"
        enter-to-class="transform scale-100 opacity-100"
        leave-active-class="transition duration-75 ease-in"
        leave-from-class="transform scale-100 opacity-100"
        leave-to-class="transform scale-95 opacity-0"
      >
        <MenuItems
          class="absolute right-0 mt-2 w-36 origin-top-right divide-y divide-gray-100 rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none"
        >
          <div class="px-1 py-1">
            <MenuItem v-slot="{ active }">
              <button
                :class="[
                  active ? 'bg-indigo-600 text-white' : 'text-gray-900',
                  'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                ]"
              >
                <UserIcon
                  :active="active"
                  class="mr-2 h-5 w-5 text-indigo-400"
                  aria-hidden="true"
                />
                Profile
              </button>
            </MenuItem>
            <MenuItem v-slot="{ active }">
              <button
              @click="logout"
                :class="[
                  active ? 'bg-indigo-600 text-white' : 'text-gray-900',
                  'group flex w-full items-center rounded-md px-2 py-2 text-sm',
                ]"
              >
                <LogoutIcon
                  :active="active"
                  class="mr-2 h-5 w-5 text-indigo-400"
                  aria-hidden="true"
                />
                Logout
              </button>
            </MenuItem>
          </div>

        </MenuItems>
      </transition>
    </Menu>
</div>
</header>

</template>

<script setup>
import { MenuIcon,LogoutIcon,UserIcon } from '@heroicons/vue/solid'
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { ChevronDownIcon } from '@heroicons/vue/solid'
import store from '../store';
import router from '../router';
import { computed } from 'vue';


const emit = defineEmits(['toggle-sidebar'])

const currentUser = computed(() => store.state.user.data)

function logout(){
    store.dispatch('logout')
    .then(() =>{
        router.push({name: 'login'})
    })
}
</script>
