<template>
  <div class="column">
    <div class="column">
      <div class="columns">
        <div class="field is-one-third column">

          <label class="label">cv actuel</label>
          <div class="control">
            <input class="input" type="text" placeholder="" >
          </div>
        </div>
        <div class="field column is-one-third">
          <label class="label">{{$t("account.studies.resume")}}</label>
          <input class="input" type="file">
        </div>
      </div>
      <div class="columns">
        <div class="field is-one-third column">
          <label class="label">{{ $t("account.studies.domain") }}</label>
          <div class="control">
            <input class="input" type="text"  v-model="professionalDesignation">
          </div>
        </div>
        <div class="field column is-one-third">
          <label class="label">{{ $t("account.studies.professional_designation") }}</label>
          <div class="control">
            <input class="input" type="text"  v-model="domain">
          </div>
        </div>
      </div>
      <div class="columns">
        <div class="field is-one-third column">
          <button class="button" type="button" @click="">{{$t("account.studies.update")}}</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "AppAccountStudies",
  data(){
    return{
      professionalDesignation:'',
      domain:''
    }
  },
}
</script>

<style scoped>

</style>