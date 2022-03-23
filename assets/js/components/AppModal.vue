<template>
  <div class="modal " :class="{'is-active' : showModal}" v-if="showModal">
    <div class="modal-background"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title"></p>
        <button class="delete" aria-label="close" @click="showModal = false"></button>
      </header>
      <section class="modal-card-body has-text-centered">
        <div v-if="showConnectionForm" class="has-text-left">
          <button class="button is-white mb-3 is-small" type="button" @click="showConnectionForm = !showConnectionForm">
              &longleftarrow; {{$t("modal.return")}}
          </button>
          <div class="field">
            <label class="label">{{ $t("modal.email") }}</label>
            <div class="control">
              <input class="input" type="email" v-model="email">
            </div>
          </div>
          <div class="field">
            <label class="label">{{ $t("modal.password") }}</label>
            <div class="control">
              <input class="input" type="password" v-model="password">
            </div>
          </div>
          <button class="button mb-6" type="button" @click="login">{{ $t("modal.validation") }}</button>
        </div>

        <template v-if="!showConnectionForm">
          <button class="button mx-3" @click="showConnectionForm = !showConnectionForm" type="button">
            {{ $t("modal.login") }}
          </button>
          <a href="/register" class="button mx-3">{{ $t("modal.register") }}</a>
        </template>
      </section>
    </div>
  </div>

</template>

<script>
import axios from "axios";

const config = {
  headers:{
    'Content-Type': 'application/json;'
  }
};
export default {
  name: "AppModal",
  data() {
    return {
      showModal: false,
      showConnectionForm: false,
      email: '',
      password: '',
    }
  },
  created() {
    this.emitter.on('modal-state', (e) => {
      this.showModal = e.modalState;
    })
  },
  methods: {
    jwtTokenApi(payload) {
      return axios.post('/auth_token', payload, config);
    },
    fetchUser(token) {
      let configToken = {
        headers:{
          'Content-Type': 'application/json;',
          'Authorization': 'bearer ' + token
        }
      };
      return axios.get('/api/me', configToken);
    },

    login() {
      let payload = {
        email: this.email,
        password: this.password
      }
      this.jwtTokenApi(payload).then((response) => {
        console.log('token:', response);
       localStorage.setItem('token',response.data.token);
       this.fetchUser(response.data.token).then((responseUser) =>{
         console.log('user:', responseUser);
         localStorage.setItem('email', responseUser.data.email);
         localStorage.setItem('iri', '/api/users/' + responseUser.data.id);
        // localStorage.setItem('type', responseUser.data.typeId);
       });
      });
    },
  },
}
</script>

<style scoped lang="scss">


</style>