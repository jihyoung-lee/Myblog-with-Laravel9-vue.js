<template>

  <div class="dark:bg-gray-900">
    <div class="container mx-auto py-9 md:py-12 lg:py-24">
      <div class="flex flex-col lg:flex-row justify-center items-strech mx-4">
        <div class="lg:w-4/12 flex justify-center items-center">
          <div>
            <h1 class="dark:text-white text-4xl md:text-5xl xl:text-6xl font-semibold text-gray-900 w-7/12">{{ post.title }}</h1>
            <p class="dark:text-gray-300 md:w-7/12 lg:w-11/12 xl:w-10/12 mt-4 lg:mt-5 text-base leading-normal text-gray-600">{{ post.body }}</p>
          </div>
        </div>
        <div class="lg:w-8/12 mt-6 md:mt-8 lg:mt-0">
          <div class="relative w-full h-full">
            <img :src="`/${post.imagePath}`" alt="" role="img" class="w-full h-full relative hidden lg:block" />
            <img :src="`/${post.imagePath}`" alt="" role="img" class="w-full h-full lg:hidden" />
            <div class="hidden lg:block absolute bottom-0 right-0 bg-red-200 w-1/2">
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  <section class="recommended">
    <h2 class="mb-12 text-center text-2xl text-gray-900 font-bold md:text-4xl">Related Post</h2>
    <div class="m-auto overflow-hidden rounded-lg shadow-lg cursor-pointer h-90 w-60 md:w-80" v-for="relatedPost in relatedPosts" :key="relatedPost.id">
      <router-link :to="{ name: 'SingleBlog', params: { slug: relatedPost.slug } }" class="block w-full h-full">
        <img :src="`/${relatedPost.imagePath}`" alt="" class="object-cover w-full max-h-40" />
        <div class="w-full p-4 bg-white dark:bg-gray-800">
          <p class="font-medium text-indigo-500 text-md">{{ relatedPost.title }}</p>
        </div>
        <p class="mb-2 text-xl font-medium text-gray-800 dark:text-white">
          Written By {{ relatedPost.user }}
        </p>
        <p class="font-light text-gray-400 dark:text-gray-300 text-md">
          {{ relatedPost.created_at }}
        </p>
      </router-link>
    </div>

  </section>

  <div class="py-16 white">
    <div class="container m-auto px-6 text-gray-600 md:px-12 xl:px-6">
      <h2 class="mb-12 text-center text-2xl text-gray-900 font-bold md:text-4xl">Who Am I?</h2>
        <div class="row-span-2 p-6 border border-gray-100 rounded-xl bg-gray-50 text-center sm:p-8">
          <div class="h-full flex flex-col justify-center space-y-4">
            <img class="w-20 h-20 mx-auto rounded-full" src="/images/myprofile.png" alt="user avatar" height="220" width="220" loading="lazy">
            <p class="text-gray-600 md:text-xl"> <span class="font-serif">php Laravel 주니어 개발자입니다. 항상 공부하고 노력합니다.</span></p>
              <h6 class="text-lg font-semibold leading-none">Written By {{ post.user }}</h6>
              <span class="text-xs text-gray-500">{{ post.created_at }}</span>
            </div>
          </div>
        </div>
    </div>

</template>
<script>
export default {
  emits: ["updateSidebar"],
  props: ["slug"],
  data() {
    return {
      post: {},
      relatedPosts: [],
    };
  },
  mounted() {
    axios
      .get("/api/posts/" + this.slug)
      .then((response) => (this.post = response.data.data))
      .catch((error) => {
        console.log(error);
      });
    axios
      .get("/api/related-posts/" + this.slug)
      .then((response) => (this.relatedPosts = response.data.data))
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>
