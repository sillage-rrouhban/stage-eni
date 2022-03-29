<template>
  <div class="column">
    <div class="columns">
      <div class="field is-one-third column">
        <label class="label">{{ $t("account.information.firstname") }}</label>
        <div class="control">
          <input class="input" type="text" v-model="currentFirstname">
        </div>
      </div>
      <div class="field column is-one-third">
        <label class="label">{{ $t("account.information.lastname") }}</label>
        <div class="control">
          <input class="input" type="text" v-model="currentLastname">
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="field is-one-third column">
        <label class="label">{{ $t("account.information.email") }}</label>
        <div class="control">
          <input class="input" type="email" v-model="email">
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="field is-one-third column">
        <label class="label">{{ $t("account.information.address") }}</label>
        <div class="control">
          <input class="input" type="text" v-model="address">
        </div>
      </div>
      <div class="field column is-one-third">
        <label class="label">{{ $t("account.information.city") }}</label>
        <div class="control">
          <input class="input" type="text" v-model="city">
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
          <input class="input" type="date" v-model="birthdate">
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="field is-one-third column">
        <button class="button" type="button" @click="submitForm">{{ $t("account.information.update") }}</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import {mapGetters} from "vuex";

const config = {
  headers: {
    'Content-Type': 'application/json;'
  }
};

export default {
  name: "AppAccountInformation",
  props: {
    me: String,
  },
  data() {
    return {
      firstname: null,
      lastname: null,
      email: '',
      address: '',
      city: '',
      zipcode: null,
      birthdate: null,
      currentFirstname: '',
      currentLastname: '',
    }
  },
  computed: {
    ...mapGetters({
      myDetails: 'users/user'
    })
  },
  async mounted() {
    await this.$store.dispatch('users/fetchUser', this.me);
    this.populateForm();
  },
  methods: {
    async submitForm() {
      let payload = {};
      if (!this.firstname || !this.isEqual(this.firstname, this.currentFirstname)) {
        payload = {
          label: this.currentFirstname,
          user: this.me,
        };
        if (!this.firstname && his.currentFirstname !== '') {
          console.log('Creating firstname');
          await this.$store.dispatch('firstname/createFirstname', payload);
        } else if (this.firstname) {
          console.log('Editing firstname');
          payload.id = this.myDetails.firstname.id;
          await this.$store.dispatch('firstname/editFirstname', payload);
        }
      }
      if (!this.lastname || !this.isEqual(this.lastname, this.currentLastname)) {
        payload = {
          label: this.currentLastname,
          user: this.me,
        };
        if (!this.lastname && this.currentLastname !== '') {
          console.log('Creating lastname');
          await this.$store.dispatch('lastname/createLastname', payload);
        } else if (this.lastname) {
          console.log('Editing lastname');
          payload.id = this.myDetails.lastname.id;
          await this.$store.dispatch('lastname/editLastname', payload);
        }
      }
    },
    populateForm() {
      this.firstname = this.myDetails.firstname ? this.myDetails.firstname.label : null;
      this.currentFirstname = this.firstname ? this.firstname : '';
      this.lastname = this.myDetails.lastname ? this.myDetails.lastname.label : null;
      this.currentLastname = this.lastname ? this.lastname : '';
      // this.lastname = this.myDetails.lastname ? this.myDetails.lastname.label : '';
      this.email = this.myDetails.email ? this.myDetails.email : '';
      //this.address = this.myDetails.phone?this.myDetails.phone.label:'';
      //this.lastname = this.myDetails.lastname?this.myDetails.lastname.label:'';
      //this.lastname = this.myDetails.lastname?this.myDetails.lastname.label:'';
      console.log('USER DETAILS ', this.myDetails);
    },

    isEqual(a, b) {
      return a.toLowerCase() === b.toLowerCase();
    },
  }
}
</script>

<style scoped lang="scss">

</style>
