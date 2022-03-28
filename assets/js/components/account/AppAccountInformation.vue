<template>
  <div class="column">
    <div class="columns">
      <div class="field is-one-third column">
        <label class="label">{{ $t("account.information.firstname") }}</label>
        <div class="control">
          <input class="input" type="text"  v-model="firstname">
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
          <input class="input" type="email"  v-model="email">
        </div>
      </div>
      <div class="field column is-one-third">
        <label class="label">{{ $t("account.information.phone") }}</label>
        <div class="control">
          <input class="input" type="text"  v-model="phone">
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="field is-one-third column">
        <label class="label">{{ $t("account.information.address") }}</label>
        <div class="control">
          <input class="input" type="text"  v-model="address">
        </div>
      </div>
      <div class="field column is-one-third">
        <label class="label">{{ $t("account.information.city") }}</label>
        <div class="control">
          <input class="input" type="text"  v-model="city">
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
          <input class="input" type="date"  v-model="birthdate">
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="field is-one-third column">
        <button class="button" type="button" @click="submitForm">{{$t("account.information.update")}}</button>
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
