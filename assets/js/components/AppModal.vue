<template>
  <div class="modal" :class="{'is-active' : showModal}" v-if="showModal">
    <div class="modal-background" @click="showModal = !showModal"></div>
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
          <figure class="modal-card-body__box">
            <img :src="login" alt="" />
            <figcaption>
              <button class="button mx-3" @click="showConnectionForm = !showConnectionForm" type="button">
                {{ $t("modal.login") }}
              </button>
            </figcaption>
          </figure>
          <div class="divider is-vertical">Or</div>
          <figure class="modal-card-body__box">
            <img :src="signup" alt="" />
            <figcaption>
              <a href="/register" class="button mx-3">{{ $t("modal.register") }}</a>
            </figcaption>
          </figure>
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
      signup: require('/assets/images/modal/add-user.svg'),
      login: require('/assets/images/modal/login.svg'),
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
      } finally {
        this.showModal = !this.showModal;
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
.modal-card-body {
  &__box {
    flex: 1 1 0;
    img {
      width: 40%;
    }
  }
}

</style>
