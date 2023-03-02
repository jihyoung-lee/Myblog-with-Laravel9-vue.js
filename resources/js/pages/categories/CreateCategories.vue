<template>

  <div class="min-h-screen w-full flex items-center justify-center bg-gray-50">
    <div>
      <!-- success message -->
      <div class="success-msg" v-if="success">
        <i class="fa fa-check"></i>
        Category created successfully
      </div>
      <form @submit.prevent="submit">
      <h1 class="mb-1 font-bold text-3xl flex gap-1 items-baseline font-mono">Create New Category!</h1>
      <div class="grid max-w-3xl gap-2 py-10 px-8 sm:grid-cols-2 bg-white rounded-md border-t-4 border-purple-400">
        <div class="grid">
          <div class="bg-white flex min-h-[60px] flex-col-reverse justify-center rounded-md border border-gray-300 px-3 py-2 shadow-sm focus-within:shadow-inner">
            <input type="text" name="first-name" id="name" v-model="field.name" class="peer block w-full border-0 p-0 text-base text-gray-900 placeholder-gray-400 focus:ring-0" placeholder="category name" />
            <label html="first-name" class="block transform text-xs font-bold uppercase text-gray-400 transition-opacity, duration-200 peer-placeholder-shown:h-0 peer-placeholder-shown:-translate-y-full peer-placeholder-shown:opacity-0">category name</label>
          </div>
        </div>
        <button type="submit" class="mt-4 bg-purple-500 text-white py-2 px-6 rounded-md hover:bg-purple-600 ">submit</button>
      </div>
      </form>
      <div class="create-categories">
        <router-link :to="{ name: 'CategoriesList' }"
        >Categories List<span>&#8594;</span></router-link
        >
      </div>
      </div>
    </div>
  </template>

  <script>
  export default {
    data() {
      return {
        field: {
            name : ""
        },
        errors: {},
        success: false,
      };
    },
    methods: {
      submit() {
        axios
          .post("/api/categories/create", this.field)
          .then(() => {
            this.field = {};
            this.errors = {};
            this.success = true;
            setInterval(() => {
              this.success = false;
            }, 2500);
          })
          .catch((error) => {
            this.errors = error.response.data.errors;
          });
      },
    },
  };
  </script>

  <style scoped>
  #create-categories {
    background-color: #f3f4f6;
    height: 90vh;
    padding: 50px;
  }
  </style>
