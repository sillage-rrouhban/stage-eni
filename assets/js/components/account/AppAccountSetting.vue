<template>
  <div class="columns">
    <div class="column">
      <div class="columns">
        <div class="field is-one-third column">
          <p></p>
          <label class="label">{{ $t("account.information.firstname") }}</label>
          <div class="control">
            <input class="input" type="text" placeholder="e.g Alex Smith" v-model="firstname">
          </div>
        </div>
        <div class="field column is-one-third">
          <label class="label">{{ $t("account.information.lastname") }}</label>
          <div class="control">
            <input class="input" type="text" placeholder="e.g Alex Smith" v-model="lastname">
          </div>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
export default {
  name: "AppAccountSetting"
}
</script>

<style scoped lang="scss">

</style>