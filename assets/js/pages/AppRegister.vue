<template>
  <div class="register">
    <app-navbar/>
  <div class="columns is-centered">
    <div class=" column is-one-third ">
      <div class="field">
        <label class="label">{{ $t("register.email") }}</label>
        <div class="control">
          <input class="input" type="email" :placeholder="$t('register.email')" v-model="email">
        </div>
      </div>

      <div class="field">
        <label class="label">{{ $t("register.password") }}</label>
        <div class="control">
          <input class="input" type="password" :placeholder="$t('register.password')" v-model="password">
        </div>
      </div>
      <div class="control">
        <button class="button is-primary" type="button" @click="sumbitForm">Submit</button>
      </div>
      {{ email }} {{ password }}
    </div>
  </div>
    <app-footer/>
  </div>
</template>

<script>
import axios from "axios";
import AppNavbar from "../components/AppNavbar";
import AppFooter from "../components/AppFooter";
const config = {
  headers: {
    'Content-Type': 'application/json;'
  }
};

export default {
  name: "AppRegister",
  components: {AppFooter, AppNavbar},
  data() {
    return {
      email: '',
      password: '',
    }
  },
  methods: {
    userApiPost(payload){
      return axios.post('/api/users',payload,config);
    },

    sumbitForm(){
      console.log("click");
      let payload = {
        email: this.email,
        plainPassword: this.password,
        type : "/api/types/1",
        status: 0,
        roles:['ROLE_USER']
      };
      this.userApiPost(payload).then((response)=>{
        console.log(response);
      });
      /*
   "email": "string",
  "type": "string",
  "plainPassword": "string"
       */
      },
    }
}
</script>

<style scoped lang="scss">
.register{
  width: 100%;
}
</style>