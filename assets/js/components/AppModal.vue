<template>
  <div class="modal " :class="{'is-active' : showModal}" v-if="showModal">
    <div class="modal-background"></div>
    <div class="modal-card">
      <section class="modal-card-body has-text-centered">

        <div v-if="showConnectionForm" class="has-text-left">
          <button class="button is-white mb-3 is-small" type="button" @click="showConnectionForm = !showConnectionForm">
            &longleftarrow; {{ $t("modal.return") }}
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
          <button class="button mb-6" type="button" @click="submitForm">{{ $t("modal.validation") }}</button>
        </div>

          <div class="is-flex" v-if="!showConnectionForm">
            <div style="flex: 1;height: 200px; background-color: #f4f5f8" >
              <button class="button mx-3" @click="showConnectionForm = !showConnectionForm" type="button">
                {{ $t("modal.login") }}
              </button>
            </div>
            <div class="divider is-vertical">Or</div>
            <div style="flex: 1;height: 200px; background-color: #f4f5f8">
              <a href="/register" class="button mx-3">{{ $t("modal.register") }}</a>
            </div>
          </div>
      </section>
    </div>
  </div>

</template>

<script>
import {mapGetters} from "vuex";

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

  computed: {
    ...mapGetters({
      user:'security/user'
    }),
  },


  created() {
    this.emitter.on('modal-state', (e) => {
      this.showModal = e.modalState;
    })
  },
  methods: {

    async submitForm() {
      let payload = {
        email: this.email,
        password: this.password,
      }
      try {
        await this.$store.dispatch('security/login', payload)
      } catch (e) {
        console.error(e);
      }
      /*
    this.jwtTokenApi(payload).then((response) => {

     this.fetchUser(response.data.token).then((responseUser) =>{

     //  localStorage.setItem('expiration',)
     });
    });
    */
    },

  },
}
</script>

<style scoped lang="scss">


</style>