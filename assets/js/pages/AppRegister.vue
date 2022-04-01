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
      </div>
    </div>
    <app-footer/>
    <app-generic-modal v-if="showModal">
      <template v-slot:title>
        {{ $t("register.creation_title") }}
      </template>
      <template v-slot:body>
        {{ $t('register.creation_confirmation') }}
      </template>
      <template v-slot:buttons>
        <button class="button" type="button" disabled>{{ $t('register.redirection') }}</button>
      </template>
    </app-generic-modal>
  </div>
</template>

<script>

import AppGenericModal from "@/components/AppGenericModal";
import AppFooter from "@/components/AppFooter";
import AppNavbar from "@/components/AppNavbar";

import {mapGetters} from "vuex";
const config = {
  headers: {
    'Content-Type': 'application/json;'
  }
};

export default {
  name: "AppRegister",
  components: {
    AppGenericModal,
    AppFooter,
    AppNavbar
  },
  data() {
    return {
      email: '',
      password: '',
      selectedType: 0,
      showModal: false
    }
  },
  computed:{
    ...mapGetters({
      types : 'types/types'
    })
  },
  created() {
    this.emitter.on('toggle-modal', (value) => {
      this.showModal = value;
    })
  },
  async mounted() {
    await this.fetchTypes();
  },
  methods: {
    emitModalClick(){
      this.emitter.emit('toggle-modal', !this.showModal);
    },
    async fetchTypes(){
      await this.$store.dispatch('types/fetchTypes');
    },
    toggleForm(id){
      this.selectedType = id;
    },
    async sumbitForm(){
      let payload = {
        email: this.email,
        plainPassword: this.password,
        type : "/api/types/" + this.selectedType,
        status: 0,
        roles:['ROLE_USER']
      };
      await this.$store.dispatch('users/createUser',payload);
      this.emitModalClick();
      setTimeout(() => {
        this.showModal = false;
        location.replace('/');
      }, 3000)
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
