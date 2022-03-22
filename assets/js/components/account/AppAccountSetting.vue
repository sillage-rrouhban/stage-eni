<template>
  <div class="column">
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
          <button class="button" type="button" @click="">{{ $t("account.setting.delete_button") }}</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AppAccountSetting",
  data() {
    return {
      currentPassword: '',
      newPassword: '',
      passwordConfirmation: '',
    }
  },

  methods: {}
}
</script>

<style scoped lang="scss">

</style>