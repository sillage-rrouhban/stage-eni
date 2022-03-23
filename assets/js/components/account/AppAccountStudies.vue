<template>
  <div class="column">
    <div class="columns">
      <div class="field is-one-third column">

        <label class="label">{{ $t("account.studies.resume_title") }}</label>
        <div class="control">
          <input class="input" type="text" placeholder="">
        </div>
      </div>
      <div class="field column is-one-third">
        <label class="label">{{ $t("account.studies.resume") }}</label>
        <input class="input" type="file">
      </div>
    </div>
    <div class="columns">
      <div class="column field is-half">
        <label class="label">{{ $t("account.studies.domain") }}</label>
        <div class="select is-multiple">
          <select multiple size="3">
            <option :value="domain.id" v-for="domain of domains" :key="domain.id">
              {{ domain.label }}
            </option>
          </select>
        </div>
      </div>
      <div class="field column is-half">
        <label class="label">{{ $t("account.studies.level") }}</label>
        <div class="select is-multiple">
          <select multiple size="3">
            <option :value="level.id" v-for="level of levels" :key="level.id">
              {{ level.label }}
            </option>
          </select>
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="field column is-one-third">
        <label class="label">{{ $t("account.studies.professional_designation") }}</label>
        <div class="control">
          <input class="input" type="text">
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="field is-one-third column">
        <button class="button" type="button" @click="">{{ $t("account.studies.update") }}</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

const config = {
  headers: {
    'Content-Type': 'application/json;'
  }
};
export default {
  name: "AppAccountStudies",
  data() {
    return {
      professionalDesignation: '',
      domains: [],
      levels: [],
      toggleDropdown: false,
    }
  },

  mounted() {
    this.fetchDomains();
    this.fetchLevels();
  },
  methods: {
    domainsApiGet() {
      return axios.get('/api/domains', config);
    },
    levelsApiGet() {
      return axios.get('/api/levels', config)
    },

    async fetchLevels() {
      let response = await this.levelsApiGet();
      this.levels = response.data;
    },

    async fetchDomains() {
      let response = await this.domainsApiGet();
      this.domains = response.data;
    },
  }
}
</script>

<style scoped>

</style>
