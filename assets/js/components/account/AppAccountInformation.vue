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
          <input class="input" type="email" disabled v-model="email">
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="field is-one-third column">
        <label class="label">{{ $t("account.information.address") }}</label>
        <div class="control">
          <input class="input" type="text" v-model="currentAddress">
        </div>
      </div>
      <div class="field column is-one-third">
        <label class="label">{{ $t("account.information.city") }}</label>
        <div class="control">
          <input class="input" type="text" v-model="currentCity">
        </div>
      </div>
      <div class="field column is-one-fifth">
        <label class="label">{{ $t("account.information.zipcode") }}</label>
        <div class="control">
          <input class="input" type="text" v-model="currentZipcode">
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="field is-one-third column">
        <label class="label">{{ $t("account.information.birthdate") }}</label>
        <div class="control">
          <input class="input" type="date" v-model="currentBirthdate">
          {{currentBirthdate}}
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
import {mapGetters} from "vuex";
import { DateTime } from "luxon";

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
      birthdate: null,
      address: null,
      city: null,
      zipcode: null,
      currentFirstname: '',
      currentLastname: '',
      currentCity: '',
      currentZipcode: '',
      currentAddress: '',
      currentBirthdate: null,
    }
  },
  computed: {
    ...mapGetters({
      myDetails: 'users/user',
      dbCity: 'cities/city',
      dbZipcode: 'zipcodes/zipcode',
    })
  },
  async mounted() {
    await this.$store.dispatch('users/fetchUser', this.me);
    this.populateForm();
  },
  methods: {
    async submitForm() {
      if (!this.firstname || !this.isEqual(this.firstname, this.currentFirstname)) {
        await this.setFirstname();
      }
      if (!this.lastname || !this.isEqual(this.lastname, this.currentLastname)) {
        await this.setLastname();
      }
      if (!this.zipcode || !this.isEqual(this.zipcode, this.currentZipcode)) {
        await this.setZipcode();
      }
      if (!this.birthdate || !this.isEqual(this.birthdate, this.currentBirthdate)) {
        await this.setBirthdate();
      }
    },
    async setFirstname() {
      let payload = {
        label: this.currentFirstname,
        user: this.me
      };
      if (!this.firstname && this.currentFirstname !== '') {
        console.log('Creating firstname');
        await this.$store.dispatch('firstnames/createFirstname', payload);
      } else if (this.firstname) {
        console.log('Editing firstname');
        payload.id = this.myDetails.firstname.id;
        await this.$store.dispatch('firstnames/editFirstname', payload);
      }
    },
    async setLastname() {
      let payload = {
        label: this.currentLastname,
        user: this.me,
      };
      if (!this.lastname && this.currentLastname !== '') {
        console.log('Creating lastname');
        await this.$store.dispatch('lastnames/createLastname', payload);
      } else if (this.lastname) {
        console.log('Editing lastname');
        payload.id = this.myDetails.lastname.id;
        await this.$store.dispatch('lastnames/editLastname', payload);
      }
    },
    async setAddress() {
      let payload = {
        label: this.currentAddress,
        user: this.me,
        city : '/api/cities/' + this.dbCity.id,
      };
      if (!this.address && this.currentAddress !== '') {
        console.log('Creating address');
        await this.$store.dispatch('addresses/createAddress', payload);
      } else if (this.address) {
        console.log('Editing address');
        payload.id = this.myDetails.address.id;
        await this.$store.dispatch('addresses/editAddress', payload);
      }
    },
    async setCity() {
      let payload = {
        label: this.currentCity,
        zipcode: '/api/zipcodes/' + this.dbZipcode.id,
      };
      if (!this.city && this.currentCity !== '') {
        console.log('Creating city');
        await this.$store.dispatch('cities/createCity', payload);
      } else if (this.city) {
        console.log('Editing city');
        payload.id = this.myDetails.city.id;
        await this.$store.dispatch('cities/editCity', payload);
      }
      if(this.dbCity){
        await this.setAddress();
      }
    },
    async setZipcode() {
      let payload = {
        label: this.currentZipcode,
      };
      if (!this.zipcode && this.currentZipcode !== '') {
        console.log('Creating zipcode');
        await this.$store.dispatch('zipcodes/createZipcode', payload);
      } else if (this.zipcode) {
        console.log('Editing zipcode');
        payload.id = this.myDetails.zipcode.id;
        await this.$store.dispatch('zipcodes/editZipcode', payload);
      }
      if(this.dbZipcode){
        await this.setCity();
      }
    },

    async setBirthdate() {
      console.log(DateTime.fromSQL(this.currentBirthdate));
      console.log(DateTime.fromFormat(this.currentBirthdate,'yyyy-mm-dd').toISO());
    //  let date = DateTime.fromFormat(this.currentBirthdate,'yyyy-mm-dd').toISO();
      let date = (DateTime.fromFormat(this.currentBirthdate,'yyyy-mm-dd'));
      console.log(date);
      let payload = {
        date: date,
        user : this.me,
      };
      if (!this.birthdate && this.currentBirthdate !== '') {
        console.log('Creating birthdate');
        await this.$store.dispatch('birthdates/createBirthdate', payload);
      } else if (this.birthdate) {
        console.log('Editing birthdate');
        payload.id = this.myDetails.birthdate.id;
        await this.$store.dispatch('birthdates/editBirthdate', payload);
      }
    },
    populateForm() {
      this.firstname = this.myDetails.firstname ? this.myDetails.firstname.label : null;
      this.currentFirstname = this.firstname ? this.firstname : '';
      this.lastname = this.myDetails.lastname ? this.myDetails.lastname.label : null;
      this.currentLastname = this.lastname ? this.lastname : '';
      this.email = this.myDetails.email ? this.myDetails.email : '';
      this.address = this.myDetails.address ? this.myDetails.address.label : null;
      this.currentAddress = this.address ? this.address : '';
      this.city = this.myDetails.address.city ? this.myDetails.address.city.label : null;
      this.currentCity = this.city ? this.city : '';
      this.zipcode = this.myDetails.address.city.zipcode ? this.myDetails.address.city.zipcode.label : null;
      this.currentZipcode = this.zipcode ? this.zipcode : '';
      if (this.myDetails.address) this.$store.dispatch('addresses/fetchAddress', this.myDetails.address.id);
      if (this.myDetails.city) this.$store.dispatch('cities/fetchCity', this.myDetails.city.id);
      if (this.myDetails.zipcode) this.$store.dispatch('zipcodes/fetchZipcode', this.myDetails.zipcode.id);
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
