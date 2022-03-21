<template>
  <div class="register">
    <app-navbar/>
    <div class="columns is-centered">
      <div class="column is-half has-text-centered">
        <h2 class="is-size-4">{{$t('register.choose-type')}}</h2>
        <div class="control">
          <button class="button is-info m-4" type="button" v-for="type of types" @click="toggleForm(type.id)" :class="{'disable':selectedType !==type.id && selectedType > 0}">
            {{$t('global.' + type.label)}}
          </button>
        </div>
      </div>
    </div>
  <div class="columns is-centered" v-if="selectedType > 0">
    <div class=" column is-one-third">
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
      types:[],
      selectedType: 0
    }
  },
  mounted() {
    this.fetchTypes();
  },

  methods: {
    userApiPost(payload){
      return axios.post('/api/users',payload,config);
    },

    fetchTypes(){
      return axios.get('/api/types',config).then((response)=>{
        this.types = response.data;
      });
    },

    toggleForm(id){
      this.selectedType = id;
      console.log(this.selectedType);
    },

    sumbitForm(){
      console.log("click");
      let payload = {
        email: this.email,
        plainPassword: this.password,
        type : "/api/types/" + this.selectedType,
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
  .disable{
    background-color: #fff;
    border-color: #3e8ed0;
    box-shadow: none;
    color: #3e8ed0;
  }
}

</style>