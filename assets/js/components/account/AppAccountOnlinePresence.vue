<template>
  <div class="column">
    <div class="columns">
      <div class="field is-one-third column">
        <label class="label">{{ $t("account.online_presence.website") }}</label>
        <div class="control">
          <input class="input" type="text" v-model="website">
        </div>
      </div>
      <div class="field column is-one-third">
        <label class="label">{{ $t("account.online_presence.other") }}</label>
        <div class="control">
          <input class="input" type="text"  v-model="other">
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="field is-one-third column">
        <button class="button" type="button" @click="">{{$t("account.online_presence.update")}}</button>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  name: "AppAccountOnlinePresence",
  data(){
    return{
      website:'',
      other:'',
    }
  },
}
</script>

<style scoped>

</style>
