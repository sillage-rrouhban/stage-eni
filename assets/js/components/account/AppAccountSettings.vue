<template>
  <div class="column">
    <div class="columns">
      <div class="field is-one-third column">
        <h5 class="title is-5">{{ $t("account.setting.password") }}</h5>
        <label class="label">{{ $t("account.setting.actual_password") }}</label>
        <div class="control">
          <input class="input" type="password" v-model="currentPassword">
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="field is-one-third column">
        <label class="label">{{ $t("account.setting.new_password") }}</label>
        <div class="control">
          <input class="input" type="password" v-model="newPassword">
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="field is-one-third column">
        <label class="label">{{ $t("account.setting.confirmation") }}</label>
        <div class="control">
          <input class="input" type="password" v-model="passwordConfirmation">
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="field is-one-third column">
        <h4 class="title is-4">{{ $t("account.setting.delete_title") }}</h4>
        <p class="has-text-justified">Lorem ipsum dolor sit amet. Qui eaque deserunt rem dolorum neque in deleniti
          voluptas eum reiciendis quidem.
          Aut quibusdam suscipit aut dignissimos dolor et quos doloremque aut quos aliquam ea eius iste.</p>
      </div>
    </div>
    <div class="columns">
      <div class="field is-one-third column">
        <button class="button" type="button" @click="toggleModal(1)">{{ $t("account.setting.delete_button") }}</button>
      </div>
    </div>
    <app-generic-modal :show-modal="showModal" v-if="typeModal === 1">
      <template v-slot:title>
        SUPPRESSION DE COMPTE
      </template>
      <template v-slot:body>
        ETES VOUS SUR DE VOULOIR SUPPRIMER TON COMPTE TA MERE ?
      </template>
      <template v-slot:buttons>
        <button class="button is-success" @click="deleteUser">Ok</button>
        <button class="button">Cancel</button>
      </template>
    </app-generic-modal>
  </div>
</template>

<script>
import AppGenericModal from "@/components/AppGenericModal";
import {mapGetters} from "vuex";
export default {
  name: "AppAccountSettings",
  components: {AppGenericModal},
  data() {
    return {
      currentPassword: '',
      newPassword: '',
      passwordConfirmation: '',
      showModal: false,
      typeModal: 0,
    }
  },
  computed: {
    ...mapGetters({
      me: 'security/user',
    }),
  },

  methods: {
    toggleModal(id){
      this.typeModal = id;
      this.showModal = true;
    },
    deleteUser(){
      console.log(this.me);
      this.$store.dispatch('users/deleteUser', this.me);
      this.$store.dispatch('security/logout');
    }
  }
  }
</script>

<style scoped lang="scss">

</style>
