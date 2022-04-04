<template>
  <div class="column">
    <div class="columns">
      <div class="field is-one-third column">
        <label class="label">{{ $t("account.setting.new_password") }}</label>
        <div class="control">
          <input class="input" type="password" v-model="newPassword" @input="comparePasswords(this.newPassword, this.passwordConfirmation)">
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="field is-one-third column">
        <label class="label">{{ $t("account.setting.confirmation") }}</label>
        <div class="control">
          <input class="input" type="password" v-model="passwordConfirmation" @input="comparePasswords(this.newPassword, this.passwordConfirmation)">
        </div>
      </div>
    </div>
    <div class="columns" v-if="(!validPasswordChange) && passwordConfirmation.length > 0">
      <div class="field is-one-third column">
        <div class="tag is-danger is-normal">Vos mots de passe de sont pas similaires</div>
      </div>
    </div>
    <div class="columns">
      <div class="field is-one-third column">
        <button class="button" type="button" :disabled="!validPasswordChange" @click="sumbitForm">CONFIRMATION</button>
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
        <button class="button" type="button" @click="emitModalClick(1)">{{ $t("account.setting.delete_button") }}</button>
      </div>
    </div>
    <app-generic-modal v-if="typeModal === 1 && showModal">
      <template v-slot:title>
        {{$t('account.setting.delete_title')}}
      </template>
      <template v-slot:body>
        {{ $t('account.setting.delete_confirmation') }}
      </template>
      <template v-slot:buttons>
        <button class="button is-success" @click="deleteUser">{{$t('modal.delete')}}</button>
        <button class="button" @click="emitModalClick(0)">{{ $t('modal.cancel') }}</button>
      </template>
    </app-generic-modal>
  </div>
</template>

<script>
import AppGenericModal from "@/components/AppGenericModal";
import {mapGetters} from "vuex";

export default {
  name: "AppAccountSettings",
  components: {
    AppGenericModal
  },
  data() {
    return {
      newPassword: '',
      passwordConfirmation: '',
      showModal: false,
      typeModal: 0,
      validPasswordChange: false,
    }
  },
  computed: {
    ...mapGetters({
      me: 'security/user',
    }),
  },
  created() {
    this.emitter.on('toggle-modal', (value) => {
      this.showModal = value;
    })
  },
  methods: {
    deleteUser() {
      this.$store.dispatch('users/deleteUser', this.me);
      this.$store.dispatch('security/logout');
    },
    async sumbitForm() {
      let payload = {
        plainPassword: this.newPassword,
        iri: this.me,
      };
      await this.$store.dispatch('users/editUser', payload);
      this.resetForm();
    },
    comparePasswords(a, b) {
      if(b.length > 0) this.validPasswordChange = (a === b);
    },
    resetForm(){
      this.newPassword = '';
      this.passwordConfirmation = '';
    },
    emitModalClick(id){
      this.typeModal = id;
      this.emitter.emit('toggle-modal', !this.showModal);
    }
  }
}
</script>

<style scoped lang="scss">

</style>
