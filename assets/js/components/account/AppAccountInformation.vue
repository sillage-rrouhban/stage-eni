<template>
  <div class="columns">
    <div class="column">
      <div class="columns">
        <div class="field is-one-third column">
          <label class="label">{{ $t("account.information.firstname") }}</label>
          <div class="control">
            <input class="input" type="text" placeholder="e.g Alex Smith" v-model="firstname">
          </div>
        </div>
        <div class="field column is-one-third">
          <label class="label">{{ $t("account.information.lastname") }}</label>
          <div class="control">
            <input class="input" type="text" placeholder="e.g Alex Smith" v-model="lastname">
          </div>
        </div>
      </div>
      <div class="columns">
        <div class="field is-one-third column">
          <label class="label">{{ $t("account.information.email") }}</label>
          <div class="control">
            <input class="input" type="email" placeholder="e.g Alex Smith" v-model="email">
          </div>
        </div>
        <div class="field column is-one-third">
          <label class="label">{{ $t("account.information.phone") }}</label>
          <div class="control">
            <input class="input" type="text" placeholder="e.g Alex Smith" v-model="phone">
          </div>
        </div>
      </div>
      <div class="columns">
        <div class="field is-one-third column">
          <label class="label">{{ $t("account.information.address") }}</label>
          <div class="control">
            <input class="input" type="text" placeholder="e.g Alex Smith" v-model="address">
          </div>
        </div>
        <div class="field column is-one-third">
          <label class="label">{{ $t("account.information.city") }}</label>
          <div class="control">
            <input class="input" type="text" placeholder="e.g Alex Smith" v-model="city">
          </div>
        </div>
        <div class="field column is-one-fifth">
          <label class="label">{{ $t("account.information.zipcode") }}</label>
          <div class="control">
            <input class="input" type="number" v-model="zipcode">
          </div>
        </div>
      </div>
      <div class="columns">
        <div class="field is-one-third column">
          <label class="label">{{ $t("account.information.birthdate") }}</label>
          <div class="control">
            <input class="input" type="date" placeholder="e.g Alex Smith" v-model="birthdate">
          </div>
        </div>
      </div>
      <div class="columns">
        <div class="field is-one-third column">
          <button class="button" type="button" @click="submitForm">Button</button>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import axios from "axios";
const config = {
  headers: {
    'Content-Type': 'application/json;'
  }
};

export default {
  name: "AppAccountInformation",
  data(){
    return{
      firstname:'',
      lastname:'',
      email:'',
      phone:'',
      address:'',
      city:'',
      zipcode:null,
      birthdate:null,
    }
  },
  methods:{
    firstnameApiPost(payload){
      return axios.post('/api/firstnames',payload,config);
    },
    lastnameApiPost(payload){
      return axios.post('/api/lastnames',payload,config);
    },
    submitForm(){
      let payload = {};
       payload = {
        label: this.firstname,
        user: "/api/users/5"
      };
    /*   this.firstnameApiPost(payload).then((response)=>{
         console.log(response);
       }).finally(()=>{
         payload={};
       });
      payload = {
        label: this.lastname,
        user: "/api/users/5"
      }; */
      this.lastnameApiPost({
        label: this.lastname,
        user: "/api/users/5"})
          .then((response)=>{
        console.log(response);
      })
          .finally(()=>{
        payload={};
      })
    }
  }
}
</script>

<style scoped lang="scss">

</style>