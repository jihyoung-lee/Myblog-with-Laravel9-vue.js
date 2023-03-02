<template>

  <section class="bg-white dark:bg-gray-900">



    <div class="container px-6 py-10 mx-auto">

      <div class="max-w-2xl mx-auto">

        <form>
          <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-gray-300">Search</label>
          <div class="relative">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
              <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="search"  v-model="title"  id="default-search" class="block p-4 pl-10 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos..." required>
            <button type="submit" class="text-white absolute right-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
          </div>
        </form>
        <!-- button -->
        <div class="flex space-x-2 justify-center ">
          <div v-for="category in categories" :key="category.id">
            <button type="button"  @click="filterByCategory(category.name)" class="inline-block px-6 py-2 border-2 border-blue-600 text-blue-600 font-medium text-xs leading-tight uppercase rounded-full hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">{{
                category.name
              }}</button>
          </div>
        </div>
        <!--         -->
        <div class="categories">
          <ul>
            <li v-for="category in categories" :key="category.id">
              <a href="#" @click="filterByCategory(category.name)"></a>
            </li>
          </ul>
        </div>
      </div>

      <div class="mt-8 lg:-mx-6 lg:flex lg:items-center" v-for="post in posts" :key="post.id">
        <img class="object-cover w-full lg:mx-6 lg:w-1/2 rounded-xl h-72 lg:h-96" :src= "post.imagePath"  alt="">

        <div class="mt-6 lg:w-1/2 lg:mt-0 lg:mx-6 ">

          <a href="#" class="block mt-4 text-2xl font-semibold text-gray-800 hover:underline dark:text-white md:text-3xl">
            <router-link
                :to="{
                    name: 'SingleBlog',
                    params: { slug: post.slug },
                  }">{{post.title}}</router-link>
          </a>

          <p class="mt-3 text-sm text-gray-500 dark:text-gray-300 md:text-sm">
            {{post.body}}
          </p>

          <div class="flex items-center mt-6">
            <img class="object-cover object-center w-10 h-10 rounded-full" src="/images/myprofile.png" alt="">

            <div class="mx-4">
              <h1 class="text-sm text-gray-700 dark:text-gray-200">Written By {{ post.user }}</h1>
              <p class="text-sm text-gray-500 dark:text-gray-400">{{ post.created_at }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <h3 v-if="!posts.length">Sorry, no match was found!</h3>
  <!-- ㅇㅇㅇ
  <div>
    <h2 class="header-title">All Blog Posts</h2>
    <div class="searchbar">
      <form action="">
        <input
            type="text"
            placeholder="Search..."
            name="search"
            v-model="title"
        />

        <button type="submit">
          <i class="fa fa-search"></i>
        </button>
      </form>
    </div>
    <div class="categories">
      <ul>
        <li v-for="category in categories" :key="category.id">
          <a href="#" @click="filterByCategory(category.name)">{{
              category.name
            }}</a>
        </li>
      </ul>
    </div>
    <section class="cards-blog latest-blog">
      <div class="card-blog-content" v-for="post in posts" :key="post.id">
        <img :src= "post.imagePath" alt="" />
        <p>
          {{ post.created_at }}
          <span style="float: right">Written By {{ post.user }}</span>
        </p>
        <h4 style="font-weight: bolder">
          <router-link
              :to="{
              name: 'SingleBlog',
              params: { slug: post.slug },
            }"
          >{{ post.title }}</router-link
          >
        </h4>
      </div>
    </section>
    <h3 v-if="!posts.length">Sorry, no match was found!</h3>
    <div class="pagination" id="pagination">
      <a
          href="#"
          v-for="(link, index) in links"
          :key="index"
          v-html="link.label"
          :class="{ active: link.active, disabled: !link.url }"
          @click="changePage(link)"
      ></a>
    </div>
  </div> -->
</template>
<script>
export default {
  emits: ["updateSidebar"],
  data() {
    return {
      posts: [],
      categories: [],
      title: "",
      links: [],
    };
  },
  methods: {
    filterByCategory(name) {
      axios
          .get("/api/posts", {
            params: {
              category: name,
            },
          })
          .then((response) => {
            this.posts = response.data.data;
            this.links = response.data.meta.links;
          })
          .catch((error) => {
            console.log(error);
          });
    },
    changePage(link) {
      if (!link.url || link.active) {
        retun;
      }
      axios
          .get(link.url)
          .then((response) => {
            this.posts = response.data.data;
            this.links = response.data.meta.links;
          })
          .catch((error) => {
            console.log(error);
          });
    },
  },
  watch: {
    title() {
      axios
          .get("/api/posts", {
            params: {
              search: this.title,
            },
          })
          .then((response) => {
            this.posts = response.data.data;
            this.links = response.data.meta.links;
          })
          .catch((error) => {
            console.log(error);
          });
    },
  },
  mounted() {
    axios
        .get("/api/posts")
        .then((response) => {
          this.posts = response.data.data;
          console.log(response.data.meta);
          this.links = response.data.meta.links;
        })
        .catch((error) => {
          console.log(error);
        });
    axios
        .get("/api/categories")
        .then((response) => (this.categories = response.data))
        .catch((error) => {
          console.log(error);
        });
  },
};
</script>
<style scoped>
h3 {
  font-size: 30px;
  text-align: center;
  margin: 50px 0;
  color: #fff;
}
.disabled {
  pointer-events: none;
}
</style>