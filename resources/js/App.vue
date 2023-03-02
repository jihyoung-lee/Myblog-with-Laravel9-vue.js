<template>
        <!-- 사이드바 내용 -->
    <nav id="header" class="w-full z-30 py-1 h-50 bg-white shadow-lg border-b border-blue-400 mt-24">
      <div class="w-full flex items-center justify-between mt-0 px-6 py-2">
        <label for="menu-toggle" class="cursor-pointer md:hidden block">
          <svg class="fill-current text-blue-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
            <title>menu</title>
            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
          </svg>
        </label>
        <input class="hidden" type="checkbox" id="menu-toggle">

        <div class="hidden md:flex md:items-center md:w-auto w-full order-3 md:order-1" id="menu">
          <nav>
            <ul class="md:flex items-center justify-between text-base text-blue-600 pt-4 md:pt-0">
              <li><a class="inline-block no-underline hover:text-black font-medium text-lg py-2 px-4 lg:-ml-2" href="#"><router-link :to="{ name: 'Home' }"
              >Home</router-link
              ></a></li>
              <li><a class="inline-block no-underline hover:text-black font-medium text-lg py-2 px-4 lg:-ml-2" href="#"><router-link :to="{ name: 'Blog' }"
              >Blog</router-link
              ></a></li>
              <li><a class="inline-block no-underline hover:text-black font-medium text-lg py-2 px-4 lg:-ml-2" href="#"><router-link  :to="{ name: 'About' }"
              >About</router-link
              ></a></li>
            </ul>
          </nav>
        </div>

        <div class="order-2 md:order-3 flex flex-wrap items-center justify-end mr-0 md:mr-4" id="nav-content">
          <div class="auth flex items-center w-full md:w-full">
            <button class="bg-transparent text-gray-800  p-2 rounded border border-gray-300 mr-4 hover:bg-gray-100 hover:text-gray-700" v-if="!loggedIn" ><router-link :to="{ name: 'Login' }"
            >Login</router-link
            ></button>
            <div class="auth flex items-center w-full md:w-full">
              <button class="bg-transparent text-gray-800  p-2 rounded border border-gray-300 mr-4 hover:bg-gray-100 hover:text-gray-700" v-if="loggedIn" ><router-link :to="{ name: 'Dashboard' }"
              >Dashboard</router-link
              ></button>
          </div>
        </div>
      </div>
      </div>
    </nav>

    <!-- main -->
  <div class="items-center flex justify-center items-center">
    <main class="container" >
      <!-- render components depending on the page visited -->
      <router-view
          @update-sidebar="updateSidebar"
          @show-edit-success="showEditSuccess"
          :editSuccess="editSuccess"
          :key="$route.path"
      ></router-view>
    </main>
  </div>


  <footer class="p-4 bg-white rounded-lg shadow md:px-6 md:py-8 dark:bg-gray-800">
    <div class="sm:flex sm:items-center sm:justify-between">
      <a href="#" target="_blank" class="flex items-center mb-4 sm:mb-0">
        <img src="/images/myprofile.png" class="mr-4 h-8" alt="Flowbite Logo" />
        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Myblog</span>
      </a>
      <ul class="flex flex-wrap items-center mb-6 sm:mb-0">
        <li>
          <a href="https://github.com/jihyoung-lee" class="mr-4 text-sm text-gray-500 hover:underline md:mr-6 dark:text-gray-400">Git Hub</a>
        </li>
      </ul>
    </div>
  </footer>
</template>
<script>
export default {
  data() {
    return {
      loggedIn: false,
      editSuccess: false,
    };
  },
  methods: {
    updateSidebar() {
      this.loggedIn = !this.loggedIn;
    },
    showEditSuccess() {
      this.editSuccess = true;
    },
  },
  mounted() {
    if (localStorage.getItem("authenticated")) {
      this.loggedIn = true;
    } else {
      this.loggedIn = false;
    }
  },
};
</script>