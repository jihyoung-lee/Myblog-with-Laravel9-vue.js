<template>
  <div style="background-color: #f4f4f0" class="sm:mx-32 lg:mx-32 xl:mx-72">
    <div class="flex justify-between container mx-auto">
      <div class="w-full">
        <div class="mt-4 px-4">
          <h1 class="font-thinner flex text-4xl pt-10 px-5">Edit Your Profile</h1>

          <form @submit.prevent="updateProfile" class="mx-5 my-5">
            <label class="relative block p-3 border-2 border-black rounded" htmlFor="name">
              <span class="text-md font-semibold text-zinc-900">Name</span>
              <input v-model="name" class="w-full bg-transparent p-0 text-sm text-gray-500 focus:outline-none" id="name" type="text" placeholder="Your name" />
            </label>

            <div class="shrink-0 mt-5">
              <img :src="url || user.profileImagePath" class="h-20 w-20 object-cover rounded-full" alt="Current profile photo" />
            </div>

            <label class="block pt-2">
              <span class="sr-only t-2">Choose profile photo</span>
              <input @change="grabFile" type="file" class="w-full text-sm text-slate-500
            file:mr-4 file:py-2 file:px-4
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            hover:file:bg-blue-200 file:text-zinc-900
            hover:file:bg-blue-300" />
            </label>

            <label class="relative block p-3 border-2 mt-5 border-black rounded" htmlFor="bio">
              <span class="text-md font-semibold text-zinc-900">Bio</span>
              <textarea v-model="bio" class="w-full p-0 text-sm border-none bg-transparent text-gray-500 focus:outline-none" id="bio" type="text" placeholder="Write Your Bio"></textarea>
            </label>

            <button class="mt-5 border-2 px-5 py-2 rounded-lg border-black border-b-4 font-black translate-y-2 border-l-4" type="submit">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'ProfileEdit',
  data() {
    return {
      user: {},
      name: '',
      bio: '',
      profileImagePath: '',
      fields: {},
      url: '',
    };
  },
  created() {
    axios.get('/api/profile', {
      headers: {
        Authorization: 'Bearer ' + localStorage.getItem('token'),
      },
    })
        .then(response => {
          this.user = response.data;
        })
        .catch(error => {
          console.log(error.response.data);
          // 에러 처리 로직 추가
        });
  },
  methods: {
    grabFile(e) {
      const file = e.target.files[0];
      this.fields.file = file;
      this.url = URL.createObjectURL(file);
      URL.revokeObjectURL(file);
    },
    updateProfile() {
      const formData = new FormData();
      formData.append('name', this.name);
      formData.append('bio', this.bio);
      formData.append('profileImagePath', this.fields.file);

      axios
          .put('/api/profile/' + this.user.id, formData, {
            headers: {
              'Content-Type': 'multipart/form-data',
              Authorization: 'Bearer ' + localStorage.getItem('token'),
            },
          })
          .then((response) => {
            console.log(response.data);
            // 변경된 프로필 정보를 반영하는 로직 추가
          })
          .catch((error) => {
            console.log(error.response.data);
          });
    }
  }
}
</script>

<style scoped>

</style>