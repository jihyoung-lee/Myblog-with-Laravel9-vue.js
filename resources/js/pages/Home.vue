<template>
  <div class="flex bg-white" style="height:600px;">
    <div class="flex items-center text-center lg:text-left px-8 md:px-12 lg:w-1/2">
      <div>
        <h2 class="text-3xl font-semibold text-gray-800 md:text-4xl">Hello, World! <span class="text-indigo-600">Jihyoung's Blog</span></h2>
        <p class="mt-2 text-sm text-gray-500 md:text-base">Laravel과 vue.js로 만들어진 블로그 웹입니다. 일상을 기록하기 위하여 만들어졌습니다.</p>
        <div class="flex justify-center lg:justify-start mt-6">
          <a class="mx-4 px-4 py-3 bg-gray-300 text-gray-900 text-xs font-semibold rounded hover:bg-gray-400" href="#"><router-link :to="{ name: 'Blog' }"
          >Learn More</router-link
          ></a>
        </div>
      </div>
    </div>
    <div class="hidden lg:block lg:w-1/2" style="clip-path:polygon(10% 0, 100% 0%, 100% 100%, 0 100%)">
      <div class="h-full object-cover" style="background-image: url(https://images.unsplash.com/photo-1498050108023-c5249f4df085?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1352&q=80)">
        <div class="h-full bg-black opacity-25"></div>
      </div>
    </div>
  </div>



  <div class="flex justify-center items-center h-screen">
    <div class="m-auto overflow-hidden rounded-lg shadow-lg cursor-pointer h-90 w-60 md:w-80" v-for="post in posts" :key="post.id">
      <router-link :to="{ name: 'SingleBlog', params: { slug: post.slug } }" class="block w-full h-full">
        <img :src="`/${post.imagePath}`" alt="blog photo" class="object-cover w-full max-h-40" />
        <div class="w-full p-4 bg-white dark:bg-gray-800">
          <p class="font-medium text-indigo-500 text-md">{{ post.title }}</p>
          <p class="mb-2 text-xl font-medium text-gray-800 dark:text-white">
            Written By {{ post.user }}
          </p>
          <p class="font-light text-gray-400 dark:text-gray-300 text-md">
            {{ post.created_at }}
          </p>
        </div>
      </router-link>
    </div>
  </div>

  <!-- This is an example component -->
  <div class="max-w-2xl mx-auto">

  </div>
    </template>
<script>
export default{
    emits: ["updateSidebar"],
    data(){
        return{
            posts:[]
        }
    },
    mounted(){
        axios
      .get("/api/home-posts")
      .then((response) => (this.posts = response.data.data))
      .catch((error) => {
        console.log(error);
      });
    }
}
</script>


